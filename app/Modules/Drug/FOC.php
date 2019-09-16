<?php

namespace App\Modules\Drug;

use App\Models\DrugStore;
use App\Models\DrugStore as DrugStoreModel;
use App\Models\FOC as FOCModel;

class FOC
{

    private $focModel;

    private $drugStoreModel;


    public function __construct()
    {
        $this->focModel = new FOCModel;
        $this->drugStoreModel = new DrugStoreModel;
    }


    public function saveFocs($foc_data, DrugStore $drugStore = null)
    {

        if ($drugStore) {

            $drugStore->foc()->delete();

            if (count($foc_data) === 0) {
                return return_msg(true, 'ok, deleted');
            }

            $drugStore->foc()->createMany($foc_data);

            return return_msg(true, 'ok');
        }

        $this->focModel->insert($this->prepareBunchFocData($foc_data));

        return return_msg(true, 'ok');
    }


    protected function prepareBunchFocData($request_data)
    {
        $focs = [];

        foreach ($request_data['foc_quantity'] as $key => $foc_quantity) {

            $focs[] = [
                'id' => $request_data['id'][$key] ?? null,
                'drug_store_id' => $request_data['drug_store_id'][$key] ?? null,
                'foc_quantity' => $foc_quantity,
                'foc_discount' => $request_data['foc_discount'][$key] ?? 0,
                'reward_points' => $request_data['reward_points'][$key] ?? 0,
                'user_id' => $request_data['user_id'] ?? null,
                'foc_on' => $request_data['foc_on'],
            ];
        }

        return $focs;
    }

    public function createFoc($foc_data)
    {

        $this->focModel->create($foc_data);
        return return_msg(true, 'ok');
    }

    public function updateOneFOC($foc_data)
    {


        $foc = $this->focModel->find($foc_data['id']);
        $foc->update($foc_data);

        return return_msg(true, 'ok');
    }

    public function deleteOneFOC($foc_id)
    {

        $this->focModel->find($foc_id)->delete();

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

    public function _saveFOCByDrugStoreId($request_data)
    {

//        $drug_store = $this->drugStoreModel->find($request_data['drug_store_id']);
//        if (!$drug_store) {
//
//            return return_msg(false, 'Not found!', [
//                'validation_errors' => [],
//                'drug_store_not_found' => true,
//                'foc_not_found' => false,
//            ]);
//        }

        if (!is_array($request_data['foc_quantity'])) {

            $this->focModel->updateOrCreate([
                'id' => $request_data['id'] ?? null
            ], $request_data);

            return return_msg(true, 'ok');
        }

        // prepare bunch foc data
        $this->focModel->insert($this->prepareBunchFocData($request_data));

        return return_msg(true, 'ok');
    }

    public function saveOneFoc($foc_data, DrugStore $drugStore = null)
    {

        if (!$drugStore) {

            $this->focModel->create([
                'user_id' => $drugStore->user_id,
                'drug_store_id' => $drugStore->id,
                'foc_quantity' => $foc_data['foc_quantity'],
                'foc_discount' => $foc_data['foc_discount'],
                'foc_on' => $foc_data['foc_on'],
            ]);
            return return_msg(true, 'ok');
        }

        $drugStore->foc()->updateOrCreate([
            'user_id' => $drugStore->user_id,
            'drug_store_id' => $drugStore->id,
            'foc_quantity' => $foc_data['foc_quantity'],
            'foc_discount' => $foc_data['foc_discount'],
            'foc_on' => $foc_data['foc_on'],
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

        return return_msg(true, 'ok');
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

        if (count($drug_store->foc) === 0) {
            return;
        }
        $drug_store->foc()->delete();
    }

    public function activateDeactivateFOC(array $data)
    {

        $foc = $this->focModel->find($data['foc_id']);
        if (!$foc) {

            return return_msg(false, 'not_found');
        }

        $foc->update(['is_activated' => $data['activated']]);

        return return_msg(true, 'ok');
    }

}