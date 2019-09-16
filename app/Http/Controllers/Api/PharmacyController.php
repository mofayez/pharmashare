<?php

namespace App\Http\Controllers\Api;

use App\Modules\Pharmacy\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PharmacyController extends Controller
{

    private $pharmacy;

    public function __construct()
    {

        $this->pharmacy = new Pharmacy();
    }


    public function blockStore(Request $request)
    {

        $validation = $this->validateBlockStoreRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $this->pharmacy->blockStore($request->all());

        return return_msg(true, 'ok');
    }


    public function unBlockStore(Request $request)
    {

        $validation = $this->validateBlockStoreRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $this->pharmacy->unBlockPharmacy($request->all());

        return return_msg(true, 'ok');
    }


    public function validateBlockStoreRequest(Request $request)
    {
        $validation = validator($request->all(), [
            'store_id' => 'required',
            'pharmacy_id' => 'required'
        ]);

        return $validation;
    }


    public function rateStore(Request $request)
    {

        $validation = $this->validateRateStoreRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->pharmacy->rateStore($request->all());
    }


    protected function validateRateStoreRequest(Request $request)
    {

        $validation = validator($request->all(), [
            'pharmacy_id' => 'required',
            'store_id' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        return $validation;
    }
    
} // end of PharmacyController function
