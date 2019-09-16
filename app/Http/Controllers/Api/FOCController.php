<?php

namespace App\Http\Controllers\Api;

use App\Modules\Drug\FOC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FOCController extends Controller
{


    private $foc;


    public function __construct()
    {

        $this->foc = new FOC();
    }


    public function createFOC(Request $request)
    {

        $request_data = $request->all();
        unset($request);

        $request_data['drugs_store_id'] = $request_data['drugs_store_id'] ?? null;

        if (isset($request_data['foc_quantity']) && is_array($request_data['foc_quantity'])) {
            $validation = $this->validateCreateMultiFOCRequest($request_data);
        } else {

            $validation = $this->validateCreateFOCRequest($request_data);
        }

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
                'drug_store_not_found' => false
            ]);
        }

        return $this->foc->saveFOCByDrugStoreId($request_data);
    }


    public function createFocGeneral(Request $request)
    {


        $request_data = $request->all();
        $request_data['drugs_store_id'] = $request_data['drugs_store_id'] ?? null;

        if (isset($request_data['foc_quantity']) && is_array($request_data['foc_quantity'])) {
            $validation = $this->validateCreateMultiFOCRequest($request_data);
        } else {
            $validation = $this->validateCreateFOCRequest($request_data);
        }


        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
                'drug_store_not_found' => false
            ]);
        }

        return $this->foc->createFoc($request_data);
    }


    public function activateDeactivateFOC(Request $request)
    {

        $validation = $this->activateDeactivateFOCRequest($request->all());

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }

        return $this->foc->activateDeactivateFOC($request->all());
    }


    public function findFOC($id)
    {

        return $this->foc->getFOC($id);
    }


    public function updateFOC(Request $request)
    {

        $request_data = $request->all();
        unset($request);

        $validation = $this->validateUpdateFOCRequest($request_data);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }

        return $this->foc->updateOneFOC($request_data);
    }


    public function allDrugStoreFoc($drug_store_id)
    {

        return $this->foc->allDrugStoreFoc($drug_store_id);
    }


    public function deleteFOC($id)
    {

        return $this->foc->deleteFoc($id);
    }


    protected function validateCreateFOCRequest($request_data)
    {

        return validator($request_data, [
            'drug_store_id' => 'required_if:foc_on,drug_store',
            'foc_quantity' => 'required|numeric',
            'foc_discount' => 'required|numeric',
            'user_id' => 'required',
            'reward_points' => 'required|numeric',
            'foc_on' => 'required|in:all,drug_store',
        ]);
    }


    protected function activateDeactivateFOCRequest($request_data)
    {

        return validator($request_data, [
            'foc_id' => 'required|exists:foc,id',
            'activated' => 'required|in:0,1'
        ]);
    }


    protected function validateCreateMultiFOCRequest($request_data)
    {

        return validator($request_data, [
            'drug_store_id.*' => 'required_if:foc_on.*,drug_store',
            'foc_quantity.*' => 'required|numeric',
            'foc_discount.*' => 'required|numeric',
            'user_id' => 'required',
            'reward_points.*' => 'required|numeric',
            'foc_on.*' => 'required|in:all,drug_store',
            'drug_store_id' => 'array|required_if:foc_on,drug_store',
            'foc_quantity' => 'array|required',
            'foc_discount' => 'array|required',
            'reward_points' => 'array|required',
            'foc_on' => 'array|required',
        ]);
    }


    protected function validateUpdateFOCRequest($request_data)
    {

        return validator($request_data, [
            'id' => 'nullable|exists:foc,id',
            'drug_store_id' => 'required_if:foc_on,drug_store',
            'foc_quantity' => 'required|numeric',
            'foc_discount' => 'required|numeric',
            'user_id' => 'required',
            'reward_points' => 'required|numeric',
            'foc_on' => 'required|in:all,drug_store',
        ]);
    }


    /** FOR TESTING PURPOSE **/
    public function getProperDrugFOC()
    {

        return $this->foc->getProperDiscountForDrugStore(13, 99);
    }
    /***/
}
