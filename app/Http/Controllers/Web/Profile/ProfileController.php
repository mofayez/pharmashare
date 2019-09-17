<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\DrugController;
use App\Http\Controllers\Api\DrugStoreController;
use App\Http\Controllers\Api\FOCController;
use App\Http\Controllers\Api\PharmacyController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Web\UtilityController;
use App\Models\AdsControl;
use Illuminate\Http\Request;
use App\Modules\User\User as UserModule;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileController extends Controller
{
    private $user;
    private $drug_ctrl;
    private $drug_store_ctrl;
    private $user_ctrl;
    private $pharmacy;
    private $sale;
    private $utility;
    private $ads;
    private $foc;

    public function __construct()
    {
        $this->user = new UserModule();
        $this->drug_ctrl = new DrugController();
        $this->drug_store_ctrl = new DrugStoreController();
        $this->user_ctrl = new UserController();
        $this->sale = new SaleController();
        $this->pharmacy = new PharmacyController();
        $this->utility = new UtilityController();
        $this->ads = new AdsController();
        $this->foc = new FOCController();

    }

    public function getBoughtsView(Request $request)
    {
        $page_title = "Boughts";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $my_orders = [];
        $request['pharmacy_id'] = $user->id;
        $response = $this->sale->getPharmacyOrders($request);
        if ($response['status']) {
            $my_orders = $response['data']['orders'];
        }
        // return $my_orders;

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {

            $second_ratio = $response2['data']['second_ratio'];
        }

        return view('pages.pharmacy.boughts.index', compact('page_title', 'user', 'all_users', 'my_orders', 'allowed_ads', 'second_ratio', 'first_ratio'));

    }

    public function getSalesView(Request $request)
    {
        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $request['store_id'] = $user->id;
        $response = $this->sale->getStoreOrders($request);

        $orders = collect([]);
        if ($response['status']) {
            $orders = $response['data']['orders'];
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($orders);
        $perPage = 20;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $orders = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $orders->setPath($request->url());

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {

            $second_ratio = $response2['data']['second_ratio'];
        }

//        return $orders;
        return view('pages.profile.sales.index', compact('page_title', 'user', 'all_users', 'orders', 'allowed_ads', 'second_ratio', 'first_ratio'));

    }

    public function getSalesReportView(Request $request)
    {
        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $response = $this->sale->findSale($request);
        $sale = null;

        if ($response['status']) {
            $sale = $response['data']['sale'];
        }
//        return $sale;
        return view('pages.reports.sales.index', compact('page_title', 'user', 'all_users', 'sale'));

    }

    public function getAddProductView()
    {
        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        return view('pages.profile.add-products.index', compact('page_title', 'user', 'all_users'));

    }

    public function getEditStoreView($id)
    {
        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $response = $this->drug_ctrl->findDrugStore($id);
        $drug_store = [];
        if ($response['status']) {
            $drug_store = $response['data']['drug'];
        }
//        return $drug_store;
        return view('pages.profile.edit-store.index', compact('page_title', 'user', 'all_users', 'drug_store'));

    }

    public function postEditDrugStore(Request $request, $id)
    {

        $foc_quantity_arr = $request->foc_quantity ?? [];
        $foc_discount_arr = $request->foc_discount ?? [];
        foreach ($foc_quantity_arr as $k => $item) {
            if ($item == 0) {
                unset($foc_quantity_arr[$k]);
                unset($foc_discount_arr[$k]);
            }
        }
        $request['foc_quantity'] = $foc_quantity_arr;
        $request['foc_discount'] = $foc_discount_arr;
        $request['id'] = $id;

        $response = $this->drug_ctrl->updateDrugStore($request);
        if (!$response['status']) {

            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));

    }

    public function deleteDrugStore(Request $request)
    {

        return $this->drug_ctrl->deleteDrugStore($request->id);

    }

    public function getAllProductsView(Request $request)
    {
        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $response = $this->drug_ctrl->allDrugsFilteredStore($request, $user->id);

        $all_drugs = [];
        if ($response['status']) {

            $all_drugs = $response['data']['drugs'];
        }
        $all_users = $this->user->all();


        $all_drugs = $all_drugs->values();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($all_drugs);
        $perPage = $request->get('limit') ?? 50;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $all_drugs = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $all_drugs->setPath($request->url());

        return view('pages.profile.all-products.index', compact('page_title', 'user', 'all_users', 'all_drugs'));

    }

    public function addPostNewProduct(Request $request)
    {
        $foc_quantity_arr = $request->foc_quantity ?? [];
        $foc_discount_arr = $request->foc_discount ?? [];
        $pharmashare_code = $request->pharmashare_code ?? bin2hex(random_bytes(10));
        foreach ($foc_quantity_arr as $k => $item) {
            if ($item == 0) {
                unset($foc_quantity_arr[$k]);
                unset($foc_discount_arr[$k]);
            }
        }
        $request['foc_quantity'] = $foc_quantity_arr;
        $request['foc_discount'] = $foc_discount_arr;
        $request['pharmashare_code'] = $pharmashare_code;

//         return $request->all();
        $request['user_id'] = auth()->user()->id;
        $response = $this->drug_ctrl->saveDrug($request);
        if (!$response['status']) {
            $errors = $response['data']['validation_errors'];
            return back()->withInput()->withErrors($errors);
        }
        return back()->with('success', __('settings.add_success'));
    }

    public function addPostProductSheet(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
//        return $request->all();
        $response = $this->drug_ctrl->saveDrug($request);
        return $response;
    }

    public function getAllCategories(Request $request)
    {
        $response = $this->drug_ctrl->allCategories($request->q);
        if ($response['status']) {
            return $response['data']['categories'];
        }
    }

    public function getAllBarcode(Request $request)
    {
        $response = $this->utility->getShareCode($request->q);
        return $response;
    }

    public function drugStoreMapView()
    {
        $page_title = "Map";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $response = $this->user_ctrl->getDrugStoreLocations();
        $all_locations = [];

        if ($response['status']) {

            $all_locations = $response['data']['users'];
        }
        $all_users = $this->user->all();

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {

            $second_ratio = $response2['data']['second_ratio'];
        }
        return view('pages.pharmacy.drugStoreMap.index', compact('page_title', 'user', 'allowed_ads', 'second_ratio', 'first_ratio', 'all_users', 'all_locations'));
    }

    public function ApproveOrder(Request $request)
    {
        return $this->sale->approveOrder($request);
    }

    public function RejectOrder(Request $request)
    {
        return $this->sale->rejectOrder($request);
    }

    public function blockPharmacy(Request $request)
    {
        $request['store_id'] = auth()->user()->id;
        $request['pharmacy_id'] = $request->pharmacy_id;
        return $this->drug_store_ctrl->blockPharmacy($request);
    }

    public function getOrderItems(Request $request)
    {
        $request['sale_id'] = $request->sale_id;
        $request['store_id'] = $request->store_id;

        $response = $this->sale->getSaleByStore($request);
        $details = [];
        if ($response['status']) {
            $details = $response['data']['sale']['details'];
        }
        return return_msg(true, '', compact('details'));
    }

    public function blockStore(Request $request)
    {
        $request['pharmacy_id'] = auth()->user()->id;
        return $this->pharmacy->blockStore($request);
    }

    public function RateStore(Request $request)
    {
        $request['pharmacy_id'] = auth()->user()->id;
        $response = $this->pharmacy->rateStore($request);
        if ($response['status']) {
            return back()->with('success', __('settings.add_success'));
        }
        return back()->with('error', 'Rating With Error');
    }

    public function getUserProfileView(Request $request, $username, $id)
    {

        $page_title = "Map";
        $response = $this->user_ctrl->getFindUser($id);
        if (!$response['status']) {
            return back()->with('error', 'user not found');
        }
        $current_user = $response['data']['user'];

        $user = auth()->user();
        $this->user->getUserImagePath($user);

        // return $current_user;
        return view('pages.profile.user.index', compact('page_title', 'user', 'current_user'));
    }

    public function getAddToFavouritesView(Request $request)
    {
        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);
        $drugs = $this->utility->getDrugsLimited(200);
        $drugs_count = $this->utility->getDrugsCount();
        $all_users = $this->user->all();
        $request->request->add(['store_id' => $user->id]);
        $favourites = $this->drug_ctrl->getStoreFavouritesIds($request);


        return view('pages.profile.add-to-favourites.index', compact('page_title', 'user', 'all_users', 'favourites', 'drugs', 'drugs_count'));

    }

    public function getDrugsData(Request $request)
    {
        $response = $this->utility->getDrugsFromModel($request);
        return $response['data']['drugs'] ?? [];
    }

    public function getDrugsFromModel(Request $request)
    {

        return $this->utility->getDrugsFromModel($request);
    }


    public function allDrugsFiltered(Request $request)
    {
        return $this->drug_ctrl->allDrugsFiltered($request);
    }

    public function addToFavourite(Request $request)
    {
        $request->request->add(['store_id' => auth()->user()->id]);
        return $this->drug_ctrl->addToFavourites($request);
    }

    public function getShowFavouritesView(Request $request)
    {

        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $request->request->add(['store_id' => $user->id]);
        $favourites = $this->drug_ctrl->getStoreFavourites($request->all());
//        return ;
        return view('pages.profile.get-all-favourites.index', compact('page_title', 'user', 'all_users', 'favourites'));

    }

    public function getAddPointsView(Request $request)
    {

        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $request->request->add(['store_id' => $user->id]);
        $favourites = $this->drug_ctrl->getStoreFavourites($request->all());
//        return $this->foc->allDrugStoreFoc($user->id);
//        return ;
        return view('pages.points.all.index', compact('page_title', 'user', 'all_users', 'favourites'));

    }

    public function handleAddPoints(Request $request)
    {
        $user = auth()->user();
        $request->request->add(['user_id' => $user->id]);
        $response = $this->foc->createFocGeneral($request);
        return $response;
    }

    public function submitFavourite(Request $request)
    {

        $request['foc_quantity'] = [];
        $request['foc_discount'] = [];
        $user = auth()->user();
        $request['id'] = $user->id;
        // return $request->all();
        $response = $this->drug_ctrl->saveDrug($request);
        if (!$response['status']) {
            return $response;
        }
        if (!$request->fav_id) {
            return $response;
        }
        $request->request->replace(['id' => $request->fav_id]);
        return $this->drug_ctrl->deleteFavourite($request);
    }

    public function deleteFavourite(Request $request)
    {
        return $this->drug_ctrl->deleteFavourite($request);
    }
}
