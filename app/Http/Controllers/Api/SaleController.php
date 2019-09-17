<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderResponseNotification;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Modules\DrugStore\DrugStore;
use App\Modules\Pharmacy\Pharmacy;
use App\Modules\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SaleController extends Controller
{

    /**
     * @var Pharmacy
     */
    private $pharmacy;

    /**
     * @var DrugStore
     */
    private $drugStore;


    /**
     * @var Sale
     */
    private $sale;


    /**
     * @var NotificationController
     */
    private $notificationsController;


    private $user;


    /**
     * SaleController constructor.
     */
    public function __construct()
    {

        $this->pharmacy = new Pharmacy();
        $this->drugStore = new DrugStore();
        $this->sale = new Sale;
        $this->notificationsController = new NotificationController();
        $this->user = new User();
    } // end of constructor function

    /**
     * submit cart and and place order
     *
     * @param Request $request
     * @return array|bool|null
     */
    public function placeOrder(Request $request)
    {


        $validation = $this->validatePlaceOrderRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'out_of_stock' => false,
                'out_of_stock_items' => [],
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $make_order_response = $this->pharmacy->makeOrder($request->all());
        
        if (!$make_order_response['status']) {
            return $make_order_response;
        } // end if 

        return $make_order_response;
    } // end of placeOrder function

    /**
     * validate place order request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatePlaceOrderRequest(Request $request)
    {

        return validator($request->all(), [
            'pharmacy_id' => 'required'
        ]);
    } // end of getOrder function


    /**
     * get pharmacy orders
     *
     * @param Request $request
     * @return array|null
     */
    public function getPharmacyOrders(Request $request)
    {

        $validation = $this->validateGetPharmacyOrdersRequest($request);
        if ($validation->fails()) {
            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }// end if

        $status = $request->status;
        switch ($status) {
            case 'order':
                $orders = $this->pharmacy->orders($request->all());
                break;
            case 'approved':
                $orders = $this->pharmacy->purchased($request->all());
                break;
            case 'rejected':
                $orders = $this->pharmacy->rejected($request->all());
                break;
            default:
                $orders = $this->pharmacy->pharmacyPurchases($request->all());
        } // end switch
        
        // group sales by stores
//        $orders = $this->assignOrdersToStore($orders);
        $orders  = $orders->sortByDesc('created_at');
        $orders = $orders->groupby('sale_number');

        return return_msg('ok', 'ok', compact('orders'));
    } // end of getPharmacyOrders function

    protected function validateGetPharmacyOrdersRequest(Request $request)
    {

        return validator($request->all(), [
            'pharmacy_id' => 'required'
        ]);
    } // end of assignOrdersToStore function

    /**
     * group sales by stores
     *
     * @param $orders
     * @return array
     */
    protected function assignOrdersToStore($orders)
    {

        $_orders = $orders->groupBy('store_id');
        $orders = [];
        foreach ($_orders as $store_id => $items) {

            $store = $items->first()->store;
            $items = $items->groupBy('sale_number');

//            $permitted_cost = $store->storeSettings->min_order_price ?? 0;
            $orders[] = [
                'store' => $store,
                'items' => $items,
//                'permitted_cost' => $items->total_cost > $permitted_cost
            ];
        }
        return array_values($orders);
    } // end of getStoreOrders function


    public function getAllOrders(Request $request)
    {
        $orders = $this->drugStore->allOrders($request->all());   
        
        return return_msg(true, 'ok', compact('orders'));
    }
    
    public function getStoreOrders(Request $request)
    {
        $validation = $this->validateGetStoreOrdersRequest($request);
        if ($validation->fails()) {
            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }// end if

        $status = $request->status;
        switch ($status) {
            case 'order':
                $orders = $this->drugStore->orders($request->all());
                break;
            case 'approved':
                $orders = $this->drugStore->purchased($request->all());
                break;
            case 'rejected':
                $orders = $this->drugStore->rejected($request->all());
                break;
            default:
                $orders = $this->drugStore->storeSales($request->all());
        } // end switch


        // apply date filters
        $this->filterByDates($request, $orders);

        // group sales by pharmacies
//        $orders = $this->assignOrdersToPharmacy($orders);
//
        foreach ($orders as $key => $items) {

            unset($orders[$key]['details']);
        }

        $orders = $orders->sortByDesc('created_at');

        return return_msg('ok', 'ok', compact('orders'));
    } // end of assignOrdersToPharmacy function


    protected function filterByDates(Request $request, &$orders)
    {

        if ($request->has('from_date') && $request->has('to_date')) {

            $from_date = Carbon::parse($request->from_date)->startOfDay();
            $to_date = Carbon::parse($request->to_date)->startOfDay();

            $orders = $orders->filter(function ($order) use ($from_date, $to_date) {
                $created_at = Carbon::parse($order->created_at)->startOfDay();
                return $created_at->gte($from_date) && $created_at->lte($to_date);
            });
        }
    }


    protected function validateGetStoreOrdersRequest(Request $request)
    {

        return validator($request->all(), [
            'store_id' => 'required'
        ]);
    } // end of rejectOrder function

    /**
     * group sales by pharmacies
     *
     * @param $orders
     * @return array
     */
    protected function assignOrdersToPharmacy($orders)
    {

        $_orders = $orders->groupBy('pharmacy_id');
        $orders = [];
        foreach ($_orders as $pharmacy_id => $items) {

            $pharmacy = $items->first()->pharmacy;
            $orders[] = [
                'pharmacy' => $pharmacy,
                'items' => $items
            ];
        }
        return array_values($orders);
    } // end of assignOrdersToPharmacy function


    /**
     * approve order
     *
     * @param Request $request
     * @return array|null
     */
    public function approveOrder(Request $request)
    {

        $validation = $this->validateApproveOrderRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $sale = $this->drugStore->approveOrderRequest($request->all());

        $this->sendApproveOrderNotification($sale);

        return return_msg(true, 'ok');
    } // end of validateGetOrdersRequest function


    protected function validateApproveOrderRequest(Request $request)
    {

        return validator($request->all(), [
            'order_id' => 'required'
        ]);
    } // end of rejectOrder function

    /**
     * reject order
     *
     * @param Request $request
     * @return array|null
     */
    public function rejectOrder(Request $request)
    {

        $validation = $this->validateRejectOrderRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $sale = $this->drugStore->rejectRequest($request->all());
        
        $this->sendRejectOrderNotification($sale);

        return return_msg(true, 'ok');
    }

    protected function validateRejectOrderRequest(Request $request)
    {

        return validator($request->all(), [
            'order_id' => 'required'
        ]);
    }

    public function sendRejectOrderNotification($sale)
    {

        $notification_desc = " {$sale->store->username} من التاجر # { $sale->id } # تم رفض الطلب بكود ";
        $notification_desc_en = "Trader  # {$sale->store->username} Order Rejected # { $sale->id } ";
        
        $data = [
            'notifiable_id' => $sale->id,
            'notifiable_type' => 'App\\Models\\Sale',
            'title' => 'تم رفض طلبك',
            'title_en' => 'Order Rejected',
            'type' => 'rejectSale',
            'description' => $notification_desc,
            'description_en' => $notification_desc_en,
            'pharmacy' => $sale->pharmacy
        ];

        $this->notificationsController->saveNotification($data);
        $this->fireOrderResponseEvent($data);
        $this->sendOrderEmail($data);
    }

    public function sendApproveOrderNotification($sale)
    {

        $notification_desc = " {$sale->store->username} من التاجر # { $sale->id } # تم الموافقه على الطلب بكود ";
        $notification_desc_en = "Trader  # {$sale->store->username} Order Accepted # { $sale->id } ";

        $data = [
            'notifiable_id' => $sale->id,
            'notifiable_type' => 'App\\Models\\Sale',
            'type' => 'approveSale',
            'title' => 'تم قبول طلبك',
            'title_en' => 'Order Accept',
            'description' => $notification_desc,
            'description_en' => $notification_desc_en,
            'pharmacy' => $sale->pharmacy
        ];
        
        $this->notificationsController->saveNotification($data);
        $this->fireOrderResponseEvent($data);
        $this->sendOrderEmail($data);
    }

    public function fireOrderResponseEvent($data)
    {
        
        event(new OrderResponseNotification($data));
    }


    public function sendOrderEmail($data)
    {

//        Mail::send('view-email', compact('data'), function ($m) use ($data) {
//            $m->from(env('MAIL_USERNAME'));
//        });
    }

    public function getSaleByStore(Request $request)
    {

        $validation = $this->validateGetSaleByStore($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->drugStore->getStoreSaleByStoreIdAndSaleId($request->all());
    }


    public function validateGetSaleByStore(Request $request)
    {

        $validation = validator($request->all(), [
            'sale_id' => 'required',
            'store_id' => 'required'
        ]);

        return $validation;
    }


    public function findSale(Request $request)
    {

        $validation = $this->validateFindSaleRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $sale = $this->sale
            ->with(['status', 'store', 'pharmacy', 'status', 'details.drugStore.drug', 'paymentType'])
            ->whereId($request->id)
            ->whereSaleNumber($request->sale_number)
            ->first();

        $sale->total_discount = $sale->details->sum(function ($sale_detail) {
            return $sale_detail->discount;
        });



        $this->user->getUserImagePath($sale->store);

        return return_msg(true, 'ok', compact('sale'));
    }

    protected function validateFindSaleRequest(Request $request)
    {

        $validation = validator($request->all(), [
            'id' => 'required',
            'sale_number' => 'required'
        ]);

        return $validation;
    }


}
