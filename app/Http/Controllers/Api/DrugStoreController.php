<?php

namespace App\Http\Controllers\Api;

use App\Modules\DrugStore\DrugStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DrugStoreController extends Controller
{

    private $drugStore;

    public function __construct()
    {

        $this->drugStore = new DrugStore();
    }

    public function saveSettings(Request $request)
    {

        $validation = $this->validateSaveSettingsRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $settings = $this->drugStore->saveSettings($request->all());

        return return_msg(true, 'ok', compact('settings'));
    }


    protected function validateSaveSettingsRequest(Request $request)
    {

        $validation = validator($request->all(), [
            'min_order_price' => 'required|numeric',
            'user_id' => 'required'
        ]);

        return $validation;
    }


    public function blockPharmacy(Request $request)
    {

        $validation = $this->validateBlockPharmacyStoreRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $this->drugStore->blockPharmacy($request->all());

        return return_msg(true, 'ok');
    }


    public function unBlockPharmacy(Request $request)
    {

        $validation = $this->validateBlockPharmacyStoreRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $this->drugStore->unBlockPharmacy($request->all());

        return return_msg(true, 'ok');
    }


    public function validateBlockPharmacyStoreRequest(Request $request)
    {
        $validation = validator($request->all(), [
            'store_id' => 'required',
            'pharmacy_id' => 'required'
        ]);

        return $validation;
    }


    public function getStoreReviews($store_id)
    {

        $store = $this->drugStore->getStoreReviews($store_id);

        return $store;
    }
}
