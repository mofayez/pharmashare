<?php

namespace App\Modules\Drug;

use App\Events\ApprovedDrugEvent;
use App\Events\RejectDrugEvent;
use App\Http\Controllers\Api\NotificationController;
use App\Models\Drug as DrugModel;
use App\Models\DrugStore as DrugStoreModel;
use App\Models\DrugStoreFavourites;
use App\Models\UnApprovedDrug as UnApprovedDrugModel;
use App\Models\PackageUserDetail;
use Illuminate\Support\Facades\DB;

class Drug
{

    /**
     * @var DrugCategory
     */
    private $drugCategory;


    /**
     * @var DrugModel
     */
    private $drugModel;

    /**
     * @var DrugStoreModel
     */
    private $drugStoreModel;

    /**
     * @var DrugStoreFavourites
     */
    private $drugStoreFavouritesModel;

    /**
     * @var DrugStoreModel
     */
    private $unApprovedDrugModel;


    private $packageUserDetail;


    private $foc;

    /**
     * @var NotificationController
     */
    private $notificationsController;

    /**
     * Drug constructor.
     */
    public function __construct()
    {

        $this->drugModel = new DrugModel;
        $this->drugStoreModel = new DrugStoreModel;
        $this->drugStoreFavouritesModel = new DrugStoreFavourites;
        $this->drugCategory = new DrugCategory();
        $this->unApprovedDrugModel = new UnApprovedDrugModel;
        $this->packageUserDetail = new PackageUserDetail;
        $this->foc = new FOC();
        $this->notificationsController = new NotificationController();
    } // end of constructor function


    /**
     * find drug by id
     *
     * @param int $id
     * @return DrugModel|DrugModel[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findDrug(int $id)
    {

        $drug = $this->drugStoreModel
            ->with(['storeUser.role', 'drugStores', 'drugCategory'])
            ->find($id);

        $this->categorizeDrugAmounts($drug);

        return $drug;
    }

    /**
     * categorize drug amounts [high, medium, low, very_low]
     *
     * @param $drug_store
     */
    protected function categorizeDrugAmounts(&$drug_store)
    {

        $amount_score = 'high';

        if ($drug_store->available_quantity_in_packs === $drug_store->minimum_order_value_or_quantity) {

            $amount_score = 'very_low';
        }

        $drug_store->amount_score = $amount_score;
    }

    /**
     * find drug by id - STORE
     *
     * @param int $id
     * @return DrugModel|DrugModel[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findDrugStore(int $id)
    {

        $drug = $this->drugStoreModel
            ->with(['storeUser.role', 'drug.drugCategory'])
            ->find($id);

        if (!$drug) {
            return null;
        }

        $this->categorizeDrugAmounts($drug);

        return $drug;
    }

    /**
     * find drug by ids - STORE
     *
     * @param array $ids
     * @return DrugModel|DrugModel[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findBunchStore(array $ids)
    {

        $drugs = $this->drugStoreModel
            ->with(['storeUser.role', 'drug.drugCategory'])
            ->find($ids);

        foreach ($drugs as $drug) {

            $this->categorizeDrugAmounts($drug);
        }

        return $drugs;
    }

    /**
     * @param array $filters
     * @return DrugModel|\Illuminate\Database\Eloquent\Builder
     */
    public function allByFilter(array $filters)
    {

        $drugs = $this->allWithoutPaginate();

        $this->filterAdminDrugs($drugs, $filters);

        return $drugs;
    }

    /**
     * retrieve all drugs
     *
     * @return DrugModel[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {

        $drugs = $this->drugModel
            ->with(['drugCategory'])
            ->paginate(100);

        return $drugs;
    }

    public function allWithoutPaginate()
    {

        $drugs = $this->drugModel
            ->with(['drugCategory'])
            ->get();

        return $drugs;
    }

    public function filterAdminDrugs(&$drugs, $filters)
    {

        if ($filters['active_ingredient'] ?? null && $filters['active_ingredient'] == 0) {

            $drugs = $drugs->filter(function ($drug) use ($filters) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }
                return strtolower(trim($master_drug->active_ingredient)) == strtolower(trim($filters['active_ingredient']));
            });
        } // end if

        if ($filters['strength'] ?? null && $filters['strength'] == 0) {

            $drugs = $drugs->filter(function ($drug) use ($filters) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }
                return strtolower(trim($master_drug->strength)) == strtolower(trim($filters['strength']));
            });
        } // end if

        if ($filters['manufacturer'] ?? null && $filters['manufacturer'] == 0) {

            $drugs = $drugs->filter(function ($drug) use ($filters) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }
                return strtolower(trim($master_drug->manufacturer)) == strtolower(trim($filters['manufacturer']));
            });
        } // end if

        if ($filters['drug_name'] ?? null) {

            $drug_name = $filters['drug_name'];

            $drugs = $drugs->filter(function ($drug) use ($drug_name) {

                $master_drug = $drug->drug;

                if (!$master_drug) {
                    return false;
                }

                return false !== stristr(strtolower(trim($master_drug->trade_name)), strtolower(trim($drug_name)));
            });
        } // end if

        if ($filters['query'] ?? null) {
            $search_query = $filters['query'];


            $drugs = $drugs->filter(function ($drug) use ($search_query) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false !== stristr(strtolower(trim($drug->trade_name)), strtolower(trim($search_query))) ||
                        false !== stristr(strtolower(trim($drug->pack_size)), strtolower(trim($search_query))) ||
                        false !== stristr(strtolower(trim($drug->form)), strtolower(trim($search_query))) ||
                        false !== stristr(strtolower(trim($drug->manufacturer)), strtolower(trim($search_query))) ||
                        false !== stristr(strtolower(trim($drug->active_ingredient)), strtolower(trim($search_query))) ||
                        false !== stristr(strtolower(trim($drug->strength)), strtolower(trim($search_query))) ||
                        false !== stristr(strtolower(trim($drug->pharmashare_code)), strtolower(trim($search_query)));
                }


                return false !== stristr(strtolower(trim($master_drug->trade_name)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->pack_size)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->form)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->manufacturer)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->active_ingredient)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->strength)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->pharmashare_code)), strtolower(trim($search_query)));
            });
        } // end if

        return $drugs;
    }

    /**
     * get all drugs bu filter STORE
     *
     * @param array $filters
     * @param null $user_id
     * @return DrugStoreModel[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allByFilterStore(array $filters, $user_id = null)
    {

        $drugs = $this->allStore($user_id, $filters);
        
        // $this->filterDrugs($drugs, $filters);
        
        return $drugs;
    }

    /**
     * retrieve all drugs STORE
     *
     * @param null $user_id
     * @return DrugStoreModel[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allStore($user_id = null, $filters = [])
    {
 
        
        if ($user_id) {

            $_drugs = $this->drugStoreModel
                ->has('packageUserDetail')
                ->where('user_id', $user_id)
                ->where('is_activate', 1);
            $_drugs = $this->drugsWhereFilters($_drugs , $filters); 
                // ->with(['storeUser.role', 'drug.drugCategory'])
                // ->get();

            $__drugs = $this->drugStoreModel
                ->doesntHave('packageUserDetail')
                ->where('user_id', $user_id)
                ->where('is_activate', 1);
            $__drugs = $this->drugsWhereFilters($__drugs , $filters);
                // ->with(['storeUser.role', 'drug.drugCategory'])
                // ->get();


        } else {

            $_drugs = $this->drugStoreModel
                ->has('packageUserDetail')
                ->where('is_activate', 1);
            $_drugs = $this->drugsWhereFilters($_drugs , $filters);
                // ->with(['storeUser.role', 'drug.drugCategory'])
                // ->get();

            $__drugs = $this->drugStoreModel
                ->doesntHave('packageUserDetail')
                ->where('is_activate', 1);
            $__drugs = $this->drugsWhereFilters($__drugs , $filters);
                // ->with(['storeUser.role', 'drug.drugCategory'])
                // ->get();
        }
        
        $_drugs = $_drugs->get();
        $__drugs = $__drugs->get();
        
        $_drugs = $_drugs->shuffle();

        $drugs = collect(array_merge($_drugs->values()->all(), $__drugs->values()->all()));

        // dd(count($drugs));
        // sort collection ** muhammad awd 06-01-2019
        $drugs = $drugs->sortByDesc('updated_at');

        unset($_drugs, $__drugs);

        foreach ($drugs as $drug) {

            $this->categorizeDrugAmounts($drug);
        }

        return $drugs;
    }

    protected function drugsWhereFilters($bulider , $filters){
        
             $bb =  $bulider->with(['storeUser.role', 'drug.drugCategory'])
            ->whereHas('drug', function($item) use ($filters){
                            if ($filters['active_ingredient'] ?? null) {
                                $item->whereRaw('MATCH (
                                    pharmashare_code,trade_name,form,pack_size,active_ingredient,strength,manufacturer
                                ) AGAINST (? IN BOOLEAN MODE)' , array("+".$filters['active_ingredient']."*"));

//                                $item->orWhere('active_ingredient','LIKE','%'.strtolower(trim($filters['active_ingredient'])).'%');

                            }
                            if ($filters['strength'] ?? null) {
                                $item->whereRaw('MATCH (
                                    pharmashare_code,trade_name,form,pack_size,active_ingredient,strength,manufacturer
                                ) AGAINST (? IN BOOLEAN MODE) ' , array("+".$filters['strength']."*"));
//                                $item->orWhere('strength','LIKE','%'.strtolower(trim($filters['strength'])).'%');
                            } // endif

                            if ($filters['manufacturer'] ?? null) {

                                $item->whereRaw('MATCH (
                                    pharmashare_code,trade_name,form,pack_size,active_ingredient,strength,manufacturer
                                ) AGAINST (? IN BOOLEAN MODE)' , array("+".$filters['manufacturer']."*"));

//                                $item->orWhere('manufacturer','LIKE','%'.strtolower(trim($filters['manufacturer'])).'%');

                            } // endif

                            if ($filters['drug_name'] ?? null) {
                                $item->whereRaw('MATCH (
                                    pharmashare_code,trade_name,form,pack_size,active_ingredient,strength,manufacturer
                                ) AGAINST (? IN BOOLEAN MODE)' , array("+".$filters['drug_name']."*"));

//                                $item->orWhere('trade_name','LIKE','%'.strtolower(trim($filters['drug_name'])).'%');

                            } // endif
//
                            if ($filters['query'] ?? null) {
                                $search_query = $filters['query'];

                                $item->whereRaw('MATCH (
                                    pharmashare_code,trade_name,form,pack_size,active_ingredient,strength,manufacturer
                                ) AGAINST (? IN BOOLEAN MODE)' , array("+".$search_query."*"));

                            } // end if          

                    });

                          if ($filters['is_featured'] ?? null) {
                                //  is_featured
                              $bb->whereHas('packageUserDetail');
                          } // end if

                            if ($filters['foc'] ?? null) {
                                //  foc
                                $bb->whereHas('foc');
                            } // end if
        return $bb;
    }

    public function filterDrugs(&$drugs, $filters)
    {

        if ($filters['min_price'] ?? null && $filters['max_price'] ?? null) {

            $drugs = $drugs
                ->where('offered_price_or_bonus', '>=', $filters['min_price'])
                ->where('offered_price_or_bonus', '<=', $filters['max_price']);
        } // end if

        if ($filters['drug_category_id'] ?? null) {

            $drugs = $drugs->filter(function ($drug) use ($filters) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }
                return $master_drug->drug_category_id == $filters['drug_category_id'];
            });
        } // end if

        if ($filters['active_ingredient'] ?? null && $filters['active_ingredient'] == 0) {

            $drugs = $drugs->filter(function ($drug) use ($filters) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }
                return strtolower(trim($master_drug->active_ingredient)) == strtolower(trim($filters['active_ingredient']));
            });
        } // end if

        if ($filters['strength'] ?? null && $filters['strength'] == 0) {

            $drugs = $drugs->filter(function ($drug) use ($filters) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }
                return strtolower(trim($master_drug->strength)) == strtolower(trim($filters['strength']));
            });
        } // end if

        if ($filters['manufacturer'] ?? null && $filters['manufacturer'] == 0) {

            $drugs = $drugs->filter(function ($drug) use ($filters) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }
                return strtolower(trim($master_drug->manufacturer)) == strtolower(trim($filters['manufacturer']));
            });
        } // end if

        if ($filters['drug_name'] ?? null) {

            $drug_name = $filters['drug_name'];

            $drugs = $drugs->filter(function ($drug) use ($drug_name) {

                $master_drug = $drug->drug;

                if (!$master_drug) {
                    return false;
                }

                return false !== stristr(strtolower(trim($master_drug->trade_name)), strtolower(trim($drug_name))) ||
                    false !== stristr(strtolower(trim($master_drug->pack_size)), strtolower(trim($drug_name))) ||
                    false !== stristr(strtolower(trim($master_drug->form)), strtolower(trim($drug_name))) ||
                    false !== stristr(strtolower(trim($master_drug->manufacturer)), strtolower(trim($drug_name))) ||
                    false !== stristr(strtolower(trim($master_drug->active_ingredient)), strtolower(trim($drug_name))) ||
                    false !== stristr(strtolower(trim($master_drug->strength)), strtolower(trim($drug_name))) ||
                    false !== stristr(strtolower(trim($master_drug->pharmashare_code)), strtolower(trim($drug_name)));

            });
        } // end if


        if ($filters['radius'] ?? null) {
            //  radius
            $radius = $filters['radius'];

            $drugs = $drugs->filter(function ($drug) use ($radius) {
                $lat1 = $drug->storeUser->location->lat ?? null;
                $lng1 = $drug->storeUser->location->lng ?? null;
                $lat2 = auth()->user()->location->lat ?? null;
                $lng2 = auth()->user()->location->lng ?? null;
                $distance = $this->distance($lat1 , $lng1 , $lat2 , $lng2); 
                
                return (($lat1 && $lng1) && ($lat2 && $lng2) && $this->distance($lat1 , $lng1 , $lat2 , $lng2)) < $radius;

            });
        } // end if


        if ($filters['is_featured'] ?? null) {
            //  is_featured
            $drugs = $drugs->filter(function ($drug) use ($radius) { 
                return $drug->isFeatured ?? false;

            });
        } // end if
        
// dd($filters['foc']);
        // if ($filters['foc'] ?? null) {
            //  foc
            $drugs = $drugs->filter(function ($drug) use ($radius) {
                dd($drug->FOC);
                if(count($drug->FOC ?? []) > 0){
                    return true;
                } else {
                    return false;
                }
            });
        // } // end if

 
        if ($filters['query'] ?? null) {

            $search_query = $filters['query'];

            $drugs = $drugs->filter(function ($drug) use ($search_query) {

                $master_drug = $drug->drug;
                if (!$master_drug) {
                    return false;
                }

                return false !== stristr(strtolower(trim($master_drug->trade_name)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->pack_size)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->form)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->manufacturer)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->active_ingredient)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->strength)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($master_drug->pharmashare_code)), strtolower(trim($search_query)));
            });
        } // end if

        return $drugs;
    }

    /**
     * compute distance in 2 coordinates
     *
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @param string $unit
     * @return float|int
     */
    protected function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "M") {
            return (int)($miles * 1.609344 * 1000);
        } else {
            return $miles;
        }
    }


    public function saveMasterDrug(array $data)
    {


        $this->prepareDrugData($data);

        $drug = $this->drugModel->updateOrCreate(
            ['pharmashare_code' => $data['pharmashare_code']],
            $data
        );

        return return_msg(true, 'ok', compact('drug'));
    }

    protected function prepareDrugData(&$data)
    {
        $data['pharmashare_code'] = $data['pharmashare_code'] ?? null;
        $data['trade_name'] = $data['trade_name'] ?? null;
        $data['form'] = $data['form'] ?? null;
        $data['pack_size'] = $data['pack_size'] ?? null;
        $data['active_ingredient'] = $data['active_ingredient'] ?? null;
        $data['strength'] = $data['strength'] ?? null;
        $data['manufacturer'] = $data['manufacturer'] ?? null;
        $data['offered_price_or_bonus'] = $data['offered_price_or_bonus'] ?? null;
        $data['minimum_order_value_or_quantity'] = $data['minimum_order_value_or_quantity'] ?? null;
        $data['available_quantity_in_packs'] = $data['available_quantity_in_packs'] ?? null;
        $data['store_remarks'] = $data['store_remarks'] ?? null;
        $data['pharmacy_price_aed'] = $data['pharmacy_price_aed'] ?? 0;
        $data['public_price_aed'] = $data['public_price_aed'] ?? 0;

        if (isset($data['foc_quantity']) && isset($data['foc_discount'])) {
            $data['foc_quantity'] = $data['foc_quantity'] ?? 0;
            $data['foc_discount'] = $data['foc_discount'] ?? 0;
        }
    }

    public function findMasterDrug(int $drug_id)
    {

        $drug = $this->drugModel->find($drug_id);

        if (!$drug) {
            return return_msg(false, 'not found');
        }

        return return_msg(true, 'ok', compact('drug'));
    }

    public function saveMasterDrugById(array $data)
    {


        $this->prepareDrugData($data);

        $drug = $this->drugModel->updateOrCreate(
            ['id' => $data['id']],
            $data
        );

        return return_msg(true, 'ok', compact('drug'));
    }

    public function deleteMasterDrugById(int $id)
    {


        $drug = $this->drugModel->find($id);

        if (!$drug) {
            return return_msg(false, 'not found');
        }

        $drug->delete();

        return return_msg(true, 'ok');
    }

    /**
     * update drug
     *
     * @param array $data
     * @return DrugModel|null
     */
    public function updateDrug(array $data)
    {

        $drug = $this->drugModel->find($data['id']); // get drug

        if (!$drug) {

            return null;
        } // end if

        $this->checkCategoryExistence($data); // check category existence
        $drug->update($data); // save new data into database

        return $drug;
    }

    /**
     * if category exists, append its id to data, else create and append.
     * @param array $data
     * @return array
     */
    public function checkCategoryExistence(array &$data)
    {

        $data['form'] = strtolower(trim($data['form']));
        $drug_category = $this->drugCategory->findByName($data['form'] ?? '');
        if (!$drug_category) {
            $drug_category = $this->drugCategory->saveDrugCategory(['title' => $data['form']]);
        }

        $data['drug_category_id'] = (int)$drug_category->id;

        return $data;
    }

    /**
     * update drug store
     *
     * @param array $data
     * @return DrugModel|null
     */
    public function updateDrugStore(array $data)
    {

        $drug = $this->drugStoreModel->find($data['id']); // get drug

        if (!$drug) {

            return null;
        } // end if

//        $this->checkCategoryExistence($data); // check category existence
        $drug->update($data); // save new data into database
        $this->saveDrugDiscount($drug, $data);

        return $drug;
    }

    protected function saveDrugDiscount($drugStore, $data)
    {

//        dd(!$this->checkIfFOCDataIsNotNull($data));
        // do nothing if there is no foc
        if (!$this->checkIfFOCDataIsNotNull($data)) {

            $this->foc->deleteFOCs($drugStore, $data);
            return;
        }


        // save many if type is array
        if (gettype($data['foc_quantity']) === 'array' && gettype($data['foc_discount']) === 'array') {

            $data = $this->prepareFocData($data);

            $this->foc->saveFocs($drugStore, $data);

            return;
        }

        // save one record id not array
        $this->foc->saveOneFoc($drugStore, [
            'foc_quantity' => $data['foc_quantity'],
            'foc_discount' => $data['foc_discount']
        ]);
    }

    protected function checkIfFOCDataIsNotNull($data)
    {
        $foc_quantity = $data['foc_quantity'] ?? null;
        $foc_discount = $data['foc_discount'] ?? null;

        return $foc_quantity && $foc_discount;
    }

    protected function prepareFocData($data)
    {
        $foc_data = [];
        $foc_quantity_array = $data['foc_quantity'] ?? [];
        foreach ($foc_quantity_array as $key => $foc_quantity) {

            if (!$this->checkIfFOCDataIsNotNull($data)) {
                continue;
            }

            $foc_data[] = [
                'foc_quantity' => $foc_quantity,
                'foc_discount' => $data['foc_discount'][$key]
            ];
        }

        return $foc_data;
    }

    /**
     * save bunch of date imported from xlsx file
     * @param $data
     * @return bool
     */
    public function saveBunchDrugsData($data)
    {

        $approved_drugs = [];
        $unapproved_drugs = [];
        $approved_drugs_count = 0;

        foreach ($data as $item) {

            /*if (!$item['drug_category']) {
                continue;
            } // end if*/

            $drug = $this->saveDrug($item);

            if ($drug['approved']) {

                $approved_drugs_count++;
                $approved_drugs[] = $drug['drug'];
            }

            if (!$drug['approved']) {

                $approved_drugs_count--;
                $unapproved_drugs[] = $drug['drug'];
                unset($drug);
            }
        } // end foreach

        return return_msg(true, 'ok', [
            'unapproved_drugs' => $unapproved_drugs,
            'approved_drugs' => $approved_drugs,
            'approved_drugs_count' => $approved_drugs_count
        ]);
    }

    /**
     * save drug
     *
     * @param array $data
     * @return mixed
     */
    public function saveDrug(array $data)
    {

        $this->prepareDrugData($data);

        $this->checkCategoryExistence($data); // check category existence

        // search fot drug existence by its pharmashare code
        $drug = $this->findDrugByPharmashareCode($data);
        if (!$drug) {

            $drug = $this->addNewDrug($data); // add new drug, UNAPPROVED


            $response = [
                'approved' => false,
                'drug' => $drug
            ];
            unset($drug);

            return $response;
        } // end if


        $drug = $this->addNewDrugStore($drug, $data); // id drug exist, append new store and alter main amount

        $response = [
            'approved' => true,
            'drug' => $drug
        ];
        unset($drug);

        return $response;
    }

    /**
     * find drug by barcode
     *
     * @param array $data ['barcode', 'user_id]
     * @return mixed
     */
    public function findDrugByPharmashareCode(array $data)
    {

        $drug = $this->drugModel
            ->with(['drugStores', 'drugCategory'])
            ->wherePharmashareCode($data['pharmashare_code'])
            ->first();

        return $drug;
    }

    /**
     * add new drug into database, UNAPPROVED
     *
     * @param array $data
     * @return mixed
     */
    public function addNewDrug(array $data)
    {

        $data['user_store_id'] = auth()->user()->id;

        // store main drug into database
        $drug = $this->unApprovedDrugModel->updateOrCreate([
            'pharmashare_code' => $data['pharmashare_code']
        ], $data);
//        $drug->drugStores()->create($data); // store into drug store database

        return $drug;
    }

    /**
     * add new drug store into database
     * alter main drug amount
     *
     * @param $drug
     * @param $data
     * @return mixed
     */
    public function addNewDrugStore($drug, $data)
    {

//        $data['drug_id'] = $drug->id;
        $data['user_id'] = $data['user_id'] ?? auth()->user()->id;

        DB::beginTransaction();
        try {

            // 1. save in drug_store table
            $drug_store = $this->drugStoreModel
                ->updateOrCreate([
                    'drug_id' => $drug->id,
                    'user_id' => $data['user_id']
                ], [
                    'minimum_order_value_or_quantity' => $data['minimum_order_value_or_quantity'] ?? 0,
                    'store_remarks' => $data['store_remarks'] ?? ''
                ]);

            // 2. save in store details table
            $drug_store->details()->create([
                'drug_store_id' => $drug_store->id,
                'amount' => $data['available_quantity_in_packs'] ?? 0,
                'price' => $data['offered_price_or_bonus'] ?? 0,
            ]);

            // 3. alter amount
            $this->alterDrugAmount($drug_store, $data['available_quantity_in_packs'] ?? 0);

            // 4. alter price
            $this->alterDrugPrice($drug_store, $data['offered_price_or_bonus'] ?? 0);

            // 5. save drug discounts
            $this->saveDrugDiscount($drug_store, $data);

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        DB::commit();
        $drug_store = $drug_store->load('drug');
        return $drug_store;
    }

    /**
     * alter drug amount (increment by passing +$amount OR decrement by passing -$amount)
     *
     * @param $drug
     * @param $amount
     * @return mixed
     */
    public function alterDrugAmount($drug, $amount)
    {
        $amount = $drug->increment('available_quantity_in_packs', $amount);

        return $amount;
    }

    /**
     * alter drug price
     *
     * @param $drug
     * @param $price
     * @return mixed
     */
    public function alterDrugPrice($drug, $price)
    {

        $drug->offered_price_or_bonus = $price;
        return $drug->save();
    }

    /**
     * find drug by barcode STORE
     *
     * @param array $data ['barcode', 'user_id]
     * @return mixed
     */
    public function findDrugByPharmashareCodeStore(array $data)
    {

        $drug = $this->drugStoreModel
            ->wherePharmashareCode($data['pharmashare_code'])
            ->first();

        $drug_store = $drug->drugStores
            ->with(['storeUser.role', 'drugStores', 'drugCategory'])
            ->where('user_id', $data['user_id'])
            ->where('drug_id', $drug->id)
            ->first();

        $this->categorizeDrugAmounts($drug_store);

        return $drug;
    }

    public function findDrugInUserStore(array $data)
    {

        $drug = $this->drugStoreModel
            ->whereUserId($data['user_id'])
            ->whereDrugId($data['drug_id'])
            ->first();

        return $drug;
    }

    public function approveDrug(array $data)
    {

        $unapproved_drug_id = $data['id'];

        DB::beginTransaction();

        try {
            // 1. find unapproved drug
            $unapproved_drug = $this->unApprovedDrugModel->find($unapproved_drug_id);

            // 2. transfer unapproved drug to normal one by storing it in drugs table
            $drug = $this->transferUnApprovedToMainDrug($unapproved_drug);

            // 3. get all instances of un approved drug
            $unapproved_drugs_instances = $this->getUnapprovedDrugInstancesByPharmasahreCode($drug->pharmashare_code);

            // 4. for each unapproved drug, add it to user's store
            foreach ($unapproved_drugs_instances as $unapproved_drugs_instance) {

                // 4.1 copy drugs to their users
                $this->addApprovedDrugToUsers($drug, $unapproved_drugs_instance);

                // 4.2 fire notification event
                $this->fireDrugApproveEvent($unapproved_drugs_instance);

                // 4.3 delete unapproved drug
                $unapproved_drugs_instance->delete();

            }

        } catch (\Exception $exception) {

            dd($exception->getMessage());
        }

        DB::commit();

        return true;
    } // end of saveBunchDrugsData data

    public function transferUnApprovedToMainDrug($unapproved_drug)
    {
        $drug = $this->drugModel->create([
            'drug_category_id' => $unapproved_drug->drug_category_id,
            'pharmashare_code' => $unapproved_drug->pharmashare_code,
            'trade_name' => $unapproved_drug->trade_name,
            'form' => $unapproved_drug->form,
            'pack_size' => $unapproved_drug->pack_size,
            'active_ingredient' => $unapproved_drug->active_ingredient,
            'strength' => $unapproved_drug->strength,
            'manufacturer' => $unapproved_drug->manufacturer,
        ]);

        return $drug;
    }

    public function getUnapprovedDrugInstancesByPharmasahreCode($parmasahre_code)
    {

        $unapproved_drugs = $this->unApprovedDrugModel
            ->wherePharmashareCode($parmasahre_code)
            ->get();

        return $unapproved_drugs;
    }

    public function addApprovedDrugToUsers($drug, $unapproved_drug)
    {

        $drug_store = $drug->drugStores()->create([
            'user_id' => $unapproved_drug->user_store_id,
            'offered_price_or_bonus' => $unapproved_drug->offered_price_or_bonus,
            'available_quantity_in_packs' => $unapproved_drug->available_quantity_in_packs,
            'minimum_order_value_or_quantity' => $unapproved_drug->minimum_order_value_or_quantity,
            'store_remarks' => $unapproved_drug->store_remarks,
        ]);

        $drug_store->details()->create([
            'amount' => $drug_store->minimum_order_value_or_quantity
        ]);

        return $drug_store;
    }


    public function fireDrugApproveEvent($un_approved_drug)
    {

        $notification_data = [
            'notifiable_id' => $un_approved_drug->user_store_id,
            'notifiable_type' => 'App\\Models\\DrugStore',
            'title' => 'تمت الموافقه على الدواء',
            'title_en' => 'Approved Drug',
            'type' => 'ApprovedDrug',
            'description' => $un_approved_drug->pharmashare_code . 'تمت الموافقه على الدواء الحامل كود رقم ',
            'description_en' =>'The drug carrying the number has been Accepted'. $un_approved_drug->pharmashare_code,
            'user_id' => $un_approved_drug->user_store_id
        ];


        $notification = $this->notificationsController->saveNotification($notification_data);


        event(new ApprovedDrugEvent($notification_data));
    }

    public function fireDrugRejectEvent($un_approved_drug)
    {

        $notification_data = [
            'notifiable_id' => $un_approved_drug->user_store_id,
            'notifiable_type' => 'App\\Models\\DrugStore',
            'title' => 'تم رفض الدواء',
            'title_en' => 'Reject Drug',
            'type' => 'RejectDrug',
            'description' => $un_approved_drug->pharmashare_code . 'تم رفض الدواء الحامل كود رقم ',
            'description_en' =>'The drug carrying the number has been rejected'. $un_approved_drug->pharmashare_code,
            'user_id' => $un_approved_drug->user_store_id
        ];

        $this->notificationsController->saveNotification($notification_data);

        event(new RejectDrugEvent($notification_data));
    }

    public function rejectUnapprovedDrug(array $data)
    {

        // 1. get all instances of un approved drug
        $unapproved_drugs_instances = $this->getUnapprovedDrugInstancesByPharmasahreCode($data['pharmashare_code']);

        // 2. for each unapproved drug, add it to user's store
        foreach ($unapproved_drugs_instances as $unapproved_drugs_instance) {

            $this->fireDrugRejectEvent($unapproved_drugs_instance);

            // 2.1 delete unapproved drug
            $unapproved_drugs_instance->delete();
        }

        return return_msg(true, 'ok');
    }

    /**
     * find drug by name
     *
     * @param array $data ['name', 'user_id']
     * @return mixed
     */
    public function findDrugByName(array $data)
    {

        $drug = $this->drugStoreModel
            ->with(['storeUser.role', 'details', 'drug.drugCategory'])
            ->whereName($data['name'])
//            ->whereUserId($data['user_id'])
            ->first();

        $this->categorizeDrugAmounts($drug);

        return $drug;
    }

    public function getUnApprovedDrugsUniquely()
    {

        $unapproved_drugs = $this->unApprovedDrugModel->orderBy('updated_at', 'desc')->get()->unique('pharmashare_code');

        return $unapproved_drugs;
    }

    /**
     * delete drug from database
     *
     * @param int $id
     * @return null
     */
    public function deleteDrug(int $id)
    {

        try {

            return $this->drugModel->find($id)->delete(); // search and delete drug

        } catch (\Exception $exception) {

            return null;
//            return $exception->getMessage();
        }
    }

    /**
     * delete drug from database STORE
     *
     * @param int $id
     * @return null
     */
    public function deleteDrugStore(int $id)
    {

        try {

            // search and delete drug
            $drug = $this->drugStoreModel->find($id);
            if ($drug) {

                $drug->update(['available_quantity_in_packs' => 0]);
                $drug->delete();
                return true;
            }

        } catch (\Exception $exception) {

            return null;
//            return $exception->getMessage();
        }

        return false;
    }

    public function returnNonExistedDrugStoreIds($drug_store_ids)
    {

        $non_exist = [];

        foreach ($drug_store_ids as $drug_store_id) {

            if (!$this->drugStoreModel->find($drug_store_ids)) {

                $non_exist[] = $drug_store_id;
            }
        }

        return $non_exist;
    }


    public function updateUnApprovedDrug(array $data)
    {
        $unapproved_drug = $this->unApprovedDrugModel->find($data['id']);
        if (!$unapproved_drug) {
            return false;
        }


        unset($data['id'], $data['_token']);
        return $this->unApprovedDrugModel->where('pharmashare_code', $unapproved_drug->pharmashare_code)->update($data);
    }

    public function addToFavourite(array $data)
    {
        return $this->drugStoreFavouritesModel->create($data);

    }

    public function getStoreFavourites(array $data)
    {
        return $this->drugStoreFavouritesModel
            ->where('store_id', $data['store_id'])
            ->with(['drug'])
            ->get();

    }

    public function getStoreFavouritesIDs(array $data)
    {
        return $this->drugStoreFavouritesModel
            ->where('store_id', $data['store_id'])
            ->get(['drug_id'])
            ->pluck(['drug_id']);

    }

    public function deleteFavourite(array $data)
    {
        return $this->drugStoreFavouritesModel
            ->find($data['id'])
            ->delete();

    }

} // end of Drug class