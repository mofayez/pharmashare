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

        $validation = $this->validateCreateFOCRequest($request_data);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
                'drug_store_not_found' => false
            ]);
        }

        return $this->foc->saveFOCByDrugStoreId($request_data);
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
                'drug_store_not_found' => false,
                'foc_not_found' => false,
            ]);
        }


        $response = $this->findFOC($request_data['id']);
        if (!$response['status']) {
            return return_msg(false, 'Not Found!', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
                'drug_store_not_found' => false,
                'foc_not_found' => true,
            ]);
        }
        unset($response);

        return $this->foc->saveFOCByDrugStoreId($request_data);
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
            'drug_store_id' => 'required',
            'foc_quantity' => 'required|numeric',
            'foc_discount' => 'required|numeric'
        ]);
    }


    protected function validateUpdateFOCRequest($request_data)
    {

        return validator($request_data, [
            'id' => 'required',
            'drug_store_id' => 'required',
            'foc_quantity' => 'required|numeric',
            'foc_discount' => 'required|numeric'
        ]);
    }


    /** FOR TESTING PURPOSE **/
    public function getProperDrugFOC()
    {

        return $this->foc->getProperDiscountForDrugStore(13, 99);
    }
    /***/
}
