<?php

namespace App\Http\Controllers\Api;

use App\Events\UnApprovedDrugInsertionEvent;
use App\Http\Controllers\Controller;
use App\Modules\Drug\Drug;
use App\Modules\Drug\DrugCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class DrugController extends Controller
{

    /**
     * @var string $storagePath
     */
    private $storagePath;

    /**
     * @var Drug $drug
     */
    private $drug;


    /**
     * @var DrugCategory
     */
    private $drugCategory;

    /**
     * @var NotificationController
     */
    private $notificationsController;

    /**
     * DrugController constructor.
     */
    public function __construct()
    {
        $this->drug = new Drug();
        $this->drugCategory = new DrugCategory();
        $this->storagePath = storage_path('files' . DIRECTORY_SEPARATOR . 'xls') . DIRECTORY_SEPARATOR;
        $this->notificationsController = new NotificationController();
    } // end of constructor function


    public function saveAdminMasterDrugs(Request $request)
    {
        if ($request->hasFile('drugsxlsx')) {

            $file = $request->file('drugsxlsx'); // get file param

            $file_name = uniqid() . '.' . $file->extension(); // get file extension
            $file->move($this->storagePath, $file_name); // save file in storage path
            $file_path = $this->storagePath . $file_name; // make path fot the file

            $data = $this->importXlsx($file_path); // import data from xlsx file

            foreach ($data as $key => $row) {

                $this->drug->checkCategoryExistence($row); // check category existence
                $this->drug->saveMasterDrug($row);
            }

            @unlink($file_path);

            return return_msg(true, 'ok');
        } // end if - xlsx file case

        $validation = $this->validateSaveDrugRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $data = $request->all();
        $this->drug->checkCategoryExistence($data); // check category existence
        return $this->drug->saveMasterDrug($data);
    }

    /**
     * import data from xlsx file
     *
     * @param $file_path
     * @return array
     */
    protected function importXlsx($file_path)
    {

        $content = Excel::load($file_path, function ($reader) {
        })->get()->values()->toArray();

        return $content;
    }

    /**
     * validate save drug request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateSaveDrugRequest(Request $request)
    {

        return validator($request->all(), [
            'pharmashare_code' => 'required',
            'form' => 'nullable',
            'pack_size' => 'nullable',
            'active_ingredient' => 'nullable',
            'trade_name' => 'required',
            'strength' => 'nullable',
            'manufacturer' => 'required',
        ]);
    }

    public function saveMasterDrugById(Request $request)
    {

        $validation = $this->validateSaveDrugRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->drug->saveMasterDrugById($request->all());
    }

    public function deleteMasterDrugById(int $id)
    {

        return $this->drug->deleteMasterDrugById($id);
    }

    public function findMasterDrug(int $drug_id)
    {

        return $this->drug->findMasterDrug($drug_id);
    }

    /**
     * save drugs into database [xlsx, normal]
     *
     * @param Request $request
     * @return array|null
     */
    public function saveDrug(Request $request)
    {
        ini_set('max_execution_time', 120);
        ini_set('memory_limit', '1024M');

        if ($request->hasFile('drugsxlsx')) {

            $file = $request->file('drugsxlsx'); // get file param

            $file_name = uniqid() . '.' . $file->extension(); // get file extension
            $file->move($this->storagePath, $file_name); // save file in storage path
            $file_path = $this->storagePath . $file_name; // make path fot the file

            $data = $this->importXlsx($file_path); // import data from xlsx file

            if (count($data) > 4000) {
                return return_msg(false, 'amount exceeded', [
                    'amount_exceeded' => true,
                    'validation_errors' => []
                ]);
            }

            $response = $this->drug->saveBunchDrugsData($data); // save whole data into database

            @unlink($file_path);

            if (count($response['data']['unapproved_drugs']) > 0) {

                $notification_data = [
                    'notifiable_id' => auth()->user()->id,
                    'admin_role_id' => 1,
                    'notifiable_type' => 'App\\Models\\User',
                    'title' => 'ادويه لم يتم الموافقه عليها',
                    'title_en' => 'Drugs unapproved',
                    'type' => 'UnApprovedDrugInsertion',
                    'description' => 'تم اضافة ادوية جديده، ويُنتظر الموافقه عليها لعرضها للصيدليات',
		    'description_en'=>'New drugs have been added and are awaiting approval to be offered to pharmacies'
                ];

                $this->notificationsController->saveNotification($notification_data);

                event(new UnApprovedDrugInsertionEvent($notification_data));
            }

            return $response;
        } // end if - xlsx file case


        $validation = $this->validateSaveDrugRequestForStore($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $data = $request->all();
        $response = $this->drug->saveDrug($data); // save data into database

        if (!$response['approved']) {

            $notification_data = [
                'notifiable_id' => auth()->user()->id,
                'notifiable_type' => 'App\\Models\\User',
                'admin_role_id' => 1,
                'title' => 'داواء لم يتم الموافقه عليه',
		'title_en'=>'A drug that has not been approved',
                'type' => 'UnApprovedDrugInsertion',
                'description' => 'تم اضافة دواء جديد، ويُنتظر الموافقه عليها لعرضها للصيدليات',
		'description_en'=>'A new drug has been added and is awaiting approval to be offered to pharmacies'
            ];

            $this->notificationsController->saveNotification($notification_data);

            event(new UnApprovedDrugInsertionEvent($notification_data));
        }

        return return_msg(true, 'ok', compact('response'));
    }

    public function validateSaveDrugRequestForStore(Request $request)
    {

        return validator($request->all(), [
            // 'pharmashare_code' => 'required',
            'form' => 'nullable',
            'pack_size' => 'required',
            'active_ingredient' => 'nullable',
            'trade_name' => 'required',
            'strength' => 'nullable',
            'manufacturer' => 'required',
            'offered_price_or_bonus' => 'required|numeric',
            'available_quantity_in_packs' => 'required|numeric',
            'minimum_order_value_or_quantity' => 'required|numeric',
            'store_remarks' => 'nullable|string|min:2|max:200',
        ]);
    }

    public function getUnApprovedDrugsUniquely()
    {

        $unapproved_drugs = $this->drug->getUnApprovedDrugsUniquely();

        return return_msg(true, 'ok', compact('unapproved_drugs'));
    }

    public function updateUnApprovedDrug(Request $request)
    {

        $validation = validator($request->all(), [
            'pharmashare_code' => 'required',
            'form' => 'nullable',
            'pack_size' => 'required',
            'active_ingredient' => 'nullable',
            'trade_name' => 'required',
            'strength' => 'nullable',
            'manufacturer' => 'required',
        ]);

        if ($validation->fails()) {
            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $updated = $this->drug->updateUnApprovedDrug($request->all());

        if (!$updated) {
            return return_msg(false, 'not found');
        }
        return return_msg(true, 'ok');
    }

    public function approveDrug(Request $request)
    {

        $data = $request->all();
        $this->drug->approveDrug($data);
        return return_msg(true, 'ok');
    }

    public function rejectUnapprovedDrug(Request $request)
    {

        return $this->drug->rejectUnapprovedDrug($request->all());
    }

    /**
     * update drug. STORE
     *
     * @param Request $request
     * @return array|null
     */
    public function updateDrugStore(Request $request)
    {

        // validate request
        $validation = $this->validateDrugStoreRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $drug = $this->drug->updateDrugStore($request->all());

        return return_msg(true, 'ok', [
            'drug' => $drug
        ]);
    }

    protected function validateDrugStoreRequest(Request $request)
    {
        return validator($request->all(), [
            'offered_price_or_bonus' => 'required|numeric',
            'available_quantity_in_packs' => 'required|numeric',
            'minimum_order_value_or_quantity' => 'required|numeric',
            'store_remarks' => 'nullable|string|min:2|max:200',
        ]);
    }

    /**
     * delete drug
     *
     * @param $id
     * @return array|null
     */
    public function deleteDrugStore($id)
    {

        $deleted = $this->drug->deleteDrugStore($id); // delete a drug

        if (!$deleted) return return_msg(false, 'Not Found'); // not found

        return return_msg(true, 'ok'); // deleted
    }


    /**
     * get drug by id
     *
     * @param $id
     * @return array|null
     */
    public function findDrugStore($id)
    {

        $drug = $this->drug->findDrugStore($id); // search for drug by id

        if (!$drug) return return_msg(false, 'Not fount');
        return return_msg(true, 'ok', compact('drug'));
    }


    /**
     * get all drugs
     *
     * @return array|null
     */
    public function allDrugs()
    {

        $drugs = $this->drug->all();

        return return_msg(true, 'ok', compact('drugs'));
    }


    /**
     * get all drugs
     * @param null $user_id
     * @return array|null
     */
    public function allDrugsStore($user_id = null)
    {

        $drugs = $this->drug->allStore($user_id);

        $this->forgetBlockedList($drugs);

        return return_msg(true, 'ok', compact('drugs'));
    }

    protected function forgetBlockedList(&$drugs)
    {

        $pharmacy = auth()->user();
        if (!$pharmacy) {

            return $drugs;
        }

        if (!$pharmacy->role->role === 'pharmacy') {

            return;
        }

        $blocked_stores_list = $pharmacy->blockedStoresIds();

        $drugs = $drugs->filter(function ($drug) use ($pharmacy, $blocked_stores_list) {

            $blocked_pharmacies_list = $drug->storeUser->blockedPharmaciesIds();

            return !in_array($drug->user_id, $blocked_stores_list) && !in_array($pharmacy->id, $blocked_pharmacies_list);
        });
    }

    /**
     * get all drugs by filters STORE
     *
     * @param Request $request
     * @param null $user_id
     * @return array|null
     */
    public function allDrugsFilteredStore(Request $request, $user_id = null)
    { 
        $drugs = $this->drug->allByFilterStore($request->all(), $user_id); 

        return return_msg(true, 'ok', compact('drugs'));
    }

    /**
     * get all drugs by filters STORE
     *
     * @param Request $request
     * @param null $user_id
     * @return array|null
     */
    public function allDrugsFiltered(Request $request)
    {

        $drugs = $this->drug->allByFilter($request->all());

        return return_msg(true, 'ok', compact('drugs'));
    }

    /**
     * get all categories
     *
     * @param $query
     * @return array|null
     */
    public function allCategories($query)
    {

        $categories = $this->drugCategory->all();

        $categories = $categories->filter(function ($category) use ($query) {

            return false !== stristr($category->title, $query);
        });

        return return_msg(true, 'ok', compact('categories'));
    }

    public function generateDefaultExcelSheet()
    {
        Excel::create('defaultDrugsSheet', function ($excel) {

            $excel->sheet('defaultDrugsSheet', function ($sheet) {

                $sheet->row(1, [
                    'Sl #', 'PharmaShare Code', 'Trade Name', 'Form', 'Pack Size', 'Active Ingredient',
                    'Strength', 'Manufacturer', 'Offered Price or Bonus', 'Minimum order Value or Quantity',
                    'Available Quantity in Packs', 'Store Remarks', 'foc quantity', 'foc discount'
                ]);

                // Set black background
                $sheet->row(1, function ($row) {

                    $row->setBackground('#8bc34a');

                });
            });

        })->export('csv');
    }


    public function generateDefaultAdminExcelSheet()
    {
        Excel::create('defaultAdminDrugsSheet', function ($excel) {

            $excel->sheet('defaultAdminDrugsSheet', function ($sheet) {

                $sheet->row(1, [
                    'Sl #', 'PharmaShare Code', 'Trade Name', 'Form', 'Pack Size', 'Active Ingredient',
                    'Strength', 'Manufacturer', 'Offered Price or Bonus', 'Minimum order Value or Quantity',
                    'Available Quantity in Packs', 'Pharmacy Price Aed', 'Public Price Aed', 'Store Remarks', 'foc quantity', 'foc discount'
                ]);

                // Set black background
                $sheet->row(1, function ($row) {

                    $row->setBackground('#8bc34a');

                });
            });

        })->export('csv');
    }

    protected function appendCategoryToDrugs(&$data)
    {

        $category_id = \App\Models\DrugCategory::where('title', 'drugs')->first()->id ?? null;
        foreach ($data as $key => $value) {

            $data[$key]['drug_category_id'] = $category_id;
        }
    }

    /**
     * @param Request $request (store_id , drug_id)
     * @return mixed
     * @author muhammad awd 13-01-2019
     */
    public function addToFavourites(Request $request)
    {
        $drugStoreFavourite = $this->drug->addToFavourite($request->except(['_token']));
        return return_msg(true, '', compact('drugStoreFavourite'));
    }

    /**
     * @param Request $request (store_id)
     * @return mixed
     * @author muhammad awd 13-01-2019
     */
    public function getStoreFavouritesIds(Request $request)
    {
        return $this->drug->getStoreFavouritesIDs($request->all());
    }

    /**
     * @param Request $request (store_id)
     * @return mixed
     * @author muhammad awd 13-01-2019
     */
    public function getStoreFavourites(array $data)
    {
        return $this->drug->getStoreFavourites($data);
    }

    /**
     * @param Request $request (id)
     * @return mixed
     * @author muhammad awd 13-01-2019
     */
    public function deleteFavourite(Request $request)
    {
        $deleted = $this->drug->deleteFavourite($request->all());

        if (!$deleted) {
            return return_msg(false, '', []);
        }
        return return_msg(true, 'deleted ', []);
    }

} // end of DrugController class
