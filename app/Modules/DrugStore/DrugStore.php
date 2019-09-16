<?php

namespace App\Modules\DrugStore;


use App\Models\BlockedPharmacy;
use App\Models\Sale;
use App\Models\Status;
use App\Models\StoreSettings;
use App\Modules\Drug\Drug;
use App\Modules\User\User;
use Illuminate\Support\Facades\DB;

class DrugStore
{

    private $sale;

    private $status;

    private $drug;

    private $storeSettings;

    private $blockedPharmacy;

    private $user;


    public function __construct()
    {

        $this->sale = new Sale;
        $this->status = new Status;
        $this->drug = new Drug();
        $this->storeSettings = new StoreSettings;
        $this->blockedPharmacy = new BlockedPharmacy;
        $this->user = new User();
    }


    public function approveOrderRequest(array $data)
    {

        $order_id = $data['order_id'];

        // 1. find sale
        $sale = $this->sale->find($order_id);

        DB::beginTransaction();
        try {

            // 2. update status to approved
            $this->alterSaleStatus($sale);

            // 3. alter amount of each drug in the order
            $this->alterSaleItemsAmounts($sale);

        } catch (\Exception $exception) {

            dd($exception->getTraceAsString());
        }

        DB::commit();

        // 4. return sale
        return $sale;
    } // end of approveOrderRequest function

    protected function alterSaleStatus(&$sale, $status = 'approved')
    {
        $sale->update([
            'status_id' => $this->getStatus($status)->id
        ]);
    }

    protected function getStatus($status_title, $status_type = 'sale')
    {

        $status = $this->status
            ->whereType($status_type)
            ->whereTitle($status_title)
            ->first();

        return $status;
    }

    protected function alterSaleItemsAmounts(&$sale)
    {
        foreach ($sale->details as $detail) {

            $drug_store = $this->drug->findDrugStore($detail->drug_store_id);
            $this->drug->alterDrugAmount($drug_store, -$detail->quantity);
        }
    }

    /**
     * reject order
     *
     * @param array $data
     * @return mixed
     */
    public function rejectRequest(array $data)
    {

        $order_id = $data['order_id'];

        // 1. find sale
        $sale = $this->sale->find($order_id);

        // 2. update status to rejected
        $this->alterSaleStatus($sale, 'rejected');

        // 3. return sale
        return $sale;
    }

    public function allOrders(array $data)
    {

        $sales = $this->sale
            ->with(['status', 'pharmacy', 'status', 'details.drugStore.drug', 'paymentType']) 
            ->get();
        
        return $sales;
    }
    
    public function orders(array $data)
    {

        $orders = $this->storeSales($data)
            ->where('status_id', $this->getStatus('order')->id);
        
        return $orders;
    }

    public function storeSales(array $data)
    {

        $store_id = $data['store_id'];
        $sales = $this->sale
            ->with(['status', 'pharmacy', 'status', 'details.drugStore.drug', 'paymentType'])
            ->whereStoreId($store_id)
            ->get();
 
        foreach ($sales as $sale) {

            $this->appendBlockedPharmacyStatus($sale);
        }
        return $sales;
    }

    public function purchased(array $data)
    {

        $orders = $this->storeSales($data)
            ->where('status_id', $this->getStatus('approved')->id);

        return $orders;
    }

    public function rejected(array $data)
    {

        $rejected = $this->storeSales($data)
            ->where('status_id', $this->getStatus('rejected')->id);

        return $rejected;
    }

    public function saveSettings(array $data)
    {

        $settings = $this->storeSettings->updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );

        return $settings;
    }


    public function blockPharmacy(array $data)
    {

        $blocked = $this->blockedPharmacy->updateOrCreate(
            ['store_id' => $data['store_id'], 'pharmacy_id' => $data['pharmacy_id']],
            $data
        );

        return $blocked;
    }

    public function unBlockPharmacy(array $data)
    {
        $blocked = $this->blockedPharmacy
            ->where('store_id', $data['store_id'])
            ->where('pharmacy_id', $data['pharmacy_id'])
            ->first();

        if (!$blocked) {

            return false;
        }

        $blocked->delete();

        return true;
    }

    public function getStoreSaleByStoreIdAndSaleId(array $data)
    {

        $sale = $this->sale
            ->with(['status', 'pharmacy', 'status', 'details.drugStore.drug', 'paymentType'])
            ->whereId($data['sale_id'])
            ->whereStoreId($data['store_id'])
            ->first();

        return return_msg(true, 'ok', compact('sale'));
    }

    protected function appendBlockedPharmacyStatus(&$sale)
    {
        $store = $sale->store;
        $pharmacy = $sale->pharmacy;

        $sale->pharmacy->blocked = in_array($pharmacy->id, $store->blockedPharmaciesIds());
    }

    public function getStoreReviews($store_id)
    {

        $response = $this->user->find($store_id);
        if (!$response['status']) {

            return $response;
        }

        $store = $response['data']['user'];
        $store->averageRatings = $store->averageRating();
        $store->load(['ratings.pharmacy']);

        foreach ($store->ratings as $rating) {

            $this->user->getUserImagePath($rating->pharmacy);
        }

        return $store;
    }

    public function getPackages($store_id)
    {
        $response = $this->user->find($store_id);
        if (!$response['status']) {

            return $response;
        }

        $user = $response['data']['user'];
        $packages = $user->packages;
        $packages->load(['package', 'details.drugStore.drug']);

        return return_msg(true, 'ok', compact('packages'));
    }

}