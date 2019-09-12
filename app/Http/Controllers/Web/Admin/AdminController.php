<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Api\DrugController;
use App\Http\Controllers\Api\DrugStoreController;
use App\Http\Controllers\Api\PostController as PsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SaleController;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Modules\User\User as UserModule;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    private $user;
    private $drug_ctrl;
    private $drug_store_ctrl;
    private $user_ctrl;
    private $sale;
    private $post;

    public function __construct()
    {
        $this->user = new UserModule();
        $this->drug_ctrl = new DrugController();
        $this->drug_store_ctrl = new DrugStoreController();
        $this->user_ctrl = new UserController();
        $this->sale = new SaleController();
        $this->post = new PsController();
    }

    public function getApprovePosts(Request $request)
    {
        $page_title = "Sales";
        $user = auth()->user();
        $posts = $this->post->getAllPosts($request->post_type, 0)['data']['posts'];


        $posts = $posts->values();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($posts);
        $perPage = $request->limit ?? 8;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $posts = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $posts->setPath($request->url())->values();
//        $posts = $posts->values();
//        return $posts;
        return view('pages.admin.approve-posts.index', compact('page_title', 'user', 'all_users', 'posts'));
    }

    public function handleApprovePosts(Request $request)
    {
        if ($post = Post::find($request->id)) {
            $post->is_approved = 1;
            $post->save();
            return return_msg(true, 'Post Is Approved');
        }
        return return_msg(false, 'Post Not Found');
    }


    public function getSalesView(Request $request)
    {
        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $response = $this->sale->getAllOrders($request);

        $orders = collect([]);
        if ($response['status']) {
            $orders = $response['data']['orders'];
        }

        // return $orders;
        $filters = $request->all();
        if ($filters['query'] ?? null) {
            $search_query = $filters['query'];
            $orders = $orders->filter(function ($order) use ($search_query) {
                return false !== stristr(strtolower(trim($order->sale_number)), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($order->status->title ?? '')), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($order->pharmacy->firstname ?? '')), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($order->pharmacy->lastname ?? '')), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($order->store->firstname ?? '')), strtolower(trim($search_query))) ||
                    false !== stristr(strtolower(trim($order->store->lastname ?? '')), strtolower(trim($search_query)));
            });
        } // end if
        $orders = $orders->values();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($orders);
        $perPage = $request->limit ?? 20;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $orders = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $orders->setPath($request->url())->values();


        return view('pages.admin.all-sales.index', compact('page_title', 'user', 'all_users', 'orders'));

    }

    public function getAdminAddProductView()
    {

        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        return view('pages.admin.add-products.index', compact('page_title', 'user', 'all_users'));

    }

    public function addAdminPostNewProduct(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $response = $this->drug_ctrl->saveAdminMasterDrugs($request);
        if (!$response['status']) {
            $errors = $response['data']['validation_errors'];
            return back()->withInput()->withErrors($errors);
        }
        return back()->with('success', __('settings.add_success'));
    }

    public function addAdminPostProductSheet(Request $request)
    {
        return $this->drug_ctrl->saveAdminMasterDrugs($request);
    }

    public function getApproveProducts(Request $request)
    {

        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $drugs = [];
        $response = $this->drug_ctrl->getUnApprovedDrugsUniquely();

        if ($response['status']) {
            $drugs = $response['data']['unapproved_drugs'];
        }

        $drugs = $drugs->values();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($drugs);
        $perPage = $request->get('limit') ?? 50;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $drugs = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $drugs->setPath($request->url());

        return view('pages.admin.approve-products.index', compact('page_title', 'user', 'all_users', 'drugs'));

    }

    public function approveDrug(Request $request)
    {
        return $this->drug_ctrl->approveDrug($request);
    }

    public function rejectDrug(Request $request)
    {
        return $this->drug_ctrl->rejectUnapprovedDrug($request);
    }


    public function getUsersAccounts()
    {

        $page_title = "Sales";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $disactivated_accounts = [];
        $accounts = [];

        $response = $this->user_ctrl->getDisActivatedUsers();
        $response2 = $this->user_ctrl->getAllUsers();

        if ($response['status']) {
            $disactivated_accounts = $response['data']['users'];
        }
        if ($response2['status']) {
            $accounts = $response2['data']['users'];
        }

        // return $disactivated_accounts;

        return view('pages.admin.users.index', compact('page_title', 'user', 'all_users', 'accounts', 'disactivated_accounts'));

    }

    public function activateAccount(Request $request)
    {
        return $this->user_ctrl->activateUser($request->id);
    }

    public function deactivateUser(Request $request)
    {
        return $this->user_ctrl->deactivateUser($request->id, $request->message, $request->message_en);
    }


    public function RemoveAccount(Request $request)
    {
        return $this->user_ctrl->deleteUserAccount($request->id);
    }

    public function getStoreRates(Request $request)
    {
        $response = $this->drug_store_ctrl->getStoreReviews($request->store_id);
        return return_msg(true, '', compact('response'));
    }

    public function getAdminAllProductView(Request $request)
    {
        $page_title = "products";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $drugs = [];
        $response = $this->drug_ctrl->allDrugsFiltered($request);
        if ($response['status']) {
            $drugs = $response['data']['drugs'];
        }

        $drugs = $drugs->values();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($drugs);
        $perPage = $request->get('limit') ?? 50;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $drugs = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $drugs->setPath($request->url());

        return view('pages.admin.all-products.index', compact('page_title', 'user', 'all_users', 'drugs'));

    }

    public function deleteAdminProduct(Request $request)
    {
        return $this->drug_ctrl->DeleteMasterDrugById($request->id);

    }

    public function getAdminEditProductView(Request $request, $id)
    {

        $page_title = "products";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $drug = [];
        $response = $this->drug_ctrl->findMasterDrug($id);

        if ($response['status']) {
            $drug = $response['data']['drug'];
        }

        return view('pages.admin.edit-product.index', compact('page_title', 'user', 'all_users', 'drug'));

    }

    public function editAdminPostNewProduct(Request $request, $id)
    {
        $request['id'] = $id;
        $response = $this->drug_ctrl->saveAdminMasterDrugs($request);

        if ($response['status']) {
            return back()->with('success', __('settings.edit_success'));
        }

        return back()->with('error', 'error');
    }
}
