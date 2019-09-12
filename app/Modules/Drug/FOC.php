<?php

namespace App\Modules\Drug;

use App\Models\DrugStore;
use App\Models\FOC as FOCModel;
use App\Models\DrugStore as DrugStoreModel;

class FOC
{

    private $focModel;

    private $drugStoreModel;


    public function __construct()
    {
        $this->focModel = new FOCModel;
        $this->drugStoreModel = new DrugStoreModel;
    }


    public function saveFocs(DrugStore $drugStore, $foc_data)
    {

        $drugStore->foc()->delete();

        if (count($foc_data) === 0) {
            return return_msg(true, 'ok, deleted');
        }

        $drugStore->foc()->createMany($foc_data);

        return return_msg(true, 'ok');
    }

    public function saveFOCByDrugStoreId($request_data)
    {

        $drug_store = $this->drugStoreModel->find($request_data['drug_store_id']);
        if (!$drug_store) {

            return return_msg(false, 'Not found!', [
                'validation_errors' => [],
                'drug_store_not_found' => true,
                'foc_not_found' => false,
            ]);
        }

        $drug_store->foc()->updateOrCreate([
            'id' => $request_data['id'] ?? null
        ], $request_data);

        return return_msg(true, 'ok');
    }



    public function saveOneFoc(DrugStore $drugStore, $foc_data)
    {

        $drugStore->foc()->updateOrCreate([
            'drug_store_id' => $drugStore->id,
            'foc_quantity' => $foc_data['foc_quantity'],
            'foc_discount' => $foc_data['foc_discount']
        ], $foc_data);

        return return_msg(true, 'ok');
    }

    public function deleteFoc($foc_id)
    {

        $foc = $this->findFoc($foc_id);

        if (!$foc) {
            return return_msg(false, 'Not found!');
        }

        $foc->delete();

        return return_msg(true, 'ok', compact('foc'));
    }

    public function findFoc($foc_id)
    {

        return $this->focModel->find($foc_id);
    }

    public function getFOC($foc_id)
    {

        $foc = $this->findFoc($foc_id);

        if (!$foc) {
            return return_msg(false, 'Not found!');
        }

        $foc->load(['drugStore.drug']);

        return return_msg(true, 'ok', compact('foc'));
    }

    public function getProperDiscountForDrugStore($drugStore_id, $quantity)
    {
        $focs = $this->focModel
            ->orderBy('foc_quantity', 'DESC')
            ->whereDrugStoreId($drugStore_id)
            ->get();

        $proper_foc = null;
        foreach ($focs as $foc) {

            if ($foc->foc_quantity <= $quantity) {
                $proper_foc = $foc;
                break;
            }
        }

        unset($focs);

        return $proper_foc;
    }


    public function allDrugStoreFoc($drug_store_id)
    {

        $foc = $this->focModel
            ->whereDrugStoreId($drug_store_id)
            ->get();

        $foc->load(['drugStore.drug']);

        return return_msg(true, 'ok', compact('foc'));
    }


    public function deleteFOCs($drug_store)
    {
        $drug_store->foc()->delete();
    }

}