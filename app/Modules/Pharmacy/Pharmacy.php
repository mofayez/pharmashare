<?php

namespace App\Modules\Pharmacy;


use App\Events\NewOrder;
use App\Http\Controllers\Api\NotificationController;
use App\Models\BlockedStore;
use App\Models\Sale as SaleModule;
use App\Models\SaleDetail;
use App\Models\Status;
use App\Models\StorePharmacyPoints;
use App\Models\StoreRating;
use App\Modules\Cart\Cart;
use App\Modules\Drug\Drug;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Pharmacy
{

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var SaleModule
     */
    private $sale;

    /**
     * @var Drug
     */
    private $drug;


    /**
     * @var BlockedStore
     */
    private $blockedStore;


    /**
     * @var StoreRating
     */
    private $storeRating;

    /**
     * @var NotificationController
     */
    private $notificationsController;


    /**
     * Pharmacy constructor.
     */
    public function __construct()
    {
        $this->drug = new Drug(); // instantiate Drug Module
        $this->cart = new Cart($this->drug); // instantiate Cart
        $this->status = new Status; // instantiate Status module
        $this->sale = new SaleModule; // instantiate Sale
        $this->blockedStore = new BlockedStore;
        $this->storeRating = new StoreRating;
        $this->notificationsController = new NotificationController();
    } // end of constructor function


    public function makeOrder(array $data)
    {
        $pharmacy_id = $data['pharmacy_id'];
        $out_of_stock_items = $this->cart->outOfStockItems();

        if (count($out_of_stock_items) > 0) {

            return return_msg(false, 'out of stock items', [
                'out_of_stock' => true,
                'out_of_stock_items' => $out_of_stock_items,
                'validation_errors' => [],
                'un_permitted_items' => []
            ]);
        }

        $cart_before_save = session()->get('cart_before_save');

        $un_permitted_orders = [];
        foreach ($cart_before_save as $item) {

            $permitted_store_limit = $item['store']->storeSettings->min_order_price ?? 0;
            if ($item['total_store_cost'] < $permitted_store_limit) {
                $un_permitted_orders[$item['store']->id] = [
                    'min_order_price' => $permitted_store_limit
                ];
            }
        }

        if (count($un_permitted_orders) > 0) {

            return return_msg(false, 'unpermitted cost', [
                'un_permitted_items' => $un_permitted_orders,
                'out_of_stock' => false,
                'out_of_stock_items' => null,
                'validation_errors' => [],
            ]);
        }

        $cart_items = session()->pull('cart_before_save') ?? [];

        if (count($cart_items) === 0) {

            return return_msg(false);
        }

        DB::beginTransaction();
        try {

            $sale_number = uniqid();

            foreach ($cart_items as $cart_item) {

                $sale = $this->storeSaleIntoDB([
                    'store_id' => $cart_item['store']->id,
                    'pharmacy_id' => $pharmacy_id,
                    'total_cost' => $cart_item['total_store_cost'],
                    'sale_number' => $sale_number,
                    'payment_type_id' => $cart_item['choosed_payment']->id,
                    'shipment' => $cart_item['shipment'],
                    'status_id' => $this->getStatus('order')->id,
                ]);

                $data = [
                    'id' => $cart_item['store']->id,
                    'title' => 'طلب جديد',
                    'description' => 'تم اضافة طلب جديد'
                ];

                $notification_data = [
                    'notifiable_id' => $cart_item['store']->id,
                    'admin_role_id' => 1,
                    'notifiable_type' => 'App\\Models\\User',
                    'title' => 'طلب جديد',
                    'title_en' => 'New Order',
                    'type' => 'NewOrder',
                    'description' => 'تم اضافة طلب جديد',
                    'description_en' => 'New Order Added'
                ];

                $this->notificationsController->saveNotification($notification_data);

                event(new NewOrder($data));

                $this->storeSaleDetailsIntoDB($sale, $cart_item['items']);
            }
        } catch (\Exception $exception) {

            dd($exception->getMessage());
        }

        DB::commit();

        $this->cart->clear();

        return return_msg(true, 'ok', compact('sale'));
    }

    /**
     * store sale in main sales table
     *
     * @param array $data
     * @return mixed
     */
    protected function storeSaleIntoDB(array $data)
    {

        $sale = $this->sale->create($data);

        return $sale;
    } // end of storeSaleIntoDB


    /**
     * get some status
     *
     * @param $status_title
     * @param string $status_type
     * @return mixed
     */
    public function getStatus($status_title, $status_type = 'sale')
    {

        $status = $this->status
            ->whereType($status_type)
            ->whereTitle($status_title)
            ->first();

        return $status;
    } // end of getStatus function


    /**
     * store order items into sale_details table
     *
     * @param $sale
     * @param $items
     */
    protected function storeSaleDetailsIntoDB($sale, $items)
    {
        $sale_details = [];
        $store_pharmacy_points = [];

        foreach ($items as $item) {
            $sale_details[] = new SaleDetail([
                'drug_store_id' => $item['id'],
                'cost' => $item['price'],
                'quantity' => $item['quantity'],
                'foc_id' => $item['foc_selected']->id ?? null,
            ]);

            if (!$item['foc_selected']) continue;

            $store_pharmacy_points[] = [
                'store_id' => $sale->store_id,
                'pharmacy_id' => $sale->pharmacy_id,
                'total_points' => $item['foc_selected']->reward_points,
                'created_at' => Carbon::now()
            ];
        } // end foreach

        $sale->details()->saveMany($sale_details);

        if (count($store_pharmacy_points) > 0) {

            StorePharmacyPoints::insert($store_pharmacy_points);
        }

    } // end of storeSaleDetailsIntoDB


    public function orders(array $data)
    {

        $orders = $this->pharmacyPurchases($data)
            ->where('status_id', $this->getStatus('order')->id);

        return $orders;
    }


    public function pharmacyPurchases(array $data)
    {

        $pharmacy_id = $data['pharmacy_id'];

        $sales = $this->sale
            ->with(['status', 'store', 'status', 'details.drugStore.drug', 'paymentType'])
            ->wherePharmacyId($pharmacy_id)
            ->get();

        foreach ($sales as $sale) {

            $this->appendBlockedStoreStatus($sale);
        }

        return $sales;
    }

    protected function appendBlockedStoreStatus(&$sale)
    {
        $store = $sale->store;
        $pharmacy = $sale->pharmacy;

        $sale->store->blocked = in_array($store->id, $pharmacy->blockedStoresIds());
    } // end of getStatus function

    public function purchased(array $data)
    {

        $orders = $this->pharmacyPurchases($data)
            ->where('status_id', $this->getStatus('approved')->id);

        return $orders;
    } // end of getStatus function

    public function rejected(array $data)
    {

        $rejected = $this->pharmacyPurchases($data)
            ->where('status_id', $this->getStatus('rejected')->id);

        return $rejected;
    }

    public function blockStore(array $data)
    {

        $blocked = $this->blockedStore->updateOrCreate(
            ['store_id' => $data['store_id'], 'pharmacy_id' => $data['pharmacy_id']],
            $data
        );

        return $blocked;
    }

    public function unBlockPharmacy(array $data)
    {
        $blocked = $this->blockedStore
            ->where('store_id', $data['store_id'])
            ->where('pharmacy_id', $data['pharmacy_id'])
            ->first();

        if (!$blocked) {

            return false;
        }

        $blocked->delete();

        return true;
    }

    public function rateStore(array $data)
    {

        $rating = $this->storeRating->updateOrCreate(
            ['pharmacy_id' => $data['pharmacy_id'], 'store_id' => $data['store_id']],
            $data
        );

        return return_msg(true, 'ok', compact('rating'));
    }
}