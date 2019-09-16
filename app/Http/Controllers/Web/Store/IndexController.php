<?php

namespace App\Http\Controllers\Web\Store;

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Web\UtilityController;
use App\Models\AdsControl;
use Illuminate\Http\Request;
use App\Modules\User\User as UserModule;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    private $user;
    private $utility;
    private $ads;

    public function __construct()
    {
        $this->user = new UserModule();
        $this->utility = new UtilityController();
        $this->ads = new AdsController();
    }

    public function index()
    {
        $page_title = "Group";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $categories = [];
        $manufacturers = [];
        $strengths = [];
        $active_ingredients = [];
        $response = $this->utility->getAllCategories();
        $response2 = $this->utility->getAllManufacturer();
        $response3 = $this->utility->getAllStrength();
        $response4 = $this->utility->getAllActiveIngredient();
        if ($response['status']) {
            $categories = $response['data']['categories'];
        }
        if ($response2['status']) {
            $manufacturers = $response2['data']['manufacturers'];
        }
        if ($response3['status']) {
            $strengths = $response3['data']['strengths'];
        }
        if ($response4['status']) {
            $active_ingredients = $response4['data']['active_ingredients'];
        }

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {

            $second_ratio = $response2['data']['second_ratio'];
        } 
         

        return view('pages.store.index', compact('page_title', 'user','allowed_ads','second_ratio', 'all_users', 'categories', 'manufacturers', 'strengths', 'active_ingredients'));

    }

    public function getDrugsData(Request $request)
    {
        $response = $this->utility->getDrugs($request);
        return $response['data']['drugs'] ?? [];
    }

    public function getDrugsWithFilterData(Request $request)
    {
        $response = $this->utility->getDrugs($request);
        return $response;
    }
}
