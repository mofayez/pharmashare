<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\DrugController;
use App\Models\Drug;
use App\Models\DrugCategory;
use App\Models\ImageAdType;
use App\Models\JobType;
use App\Models\PaymentType;
use App\Models\Role;
use App\Models\StoreSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UtilityController extends Controller
{
    public function setAr()
    {
        config('app')['locale'] == 'ar';
        session(['current_lang' => 'ar']);
        return back();
    }

    public function setEn()
    {
        config('app')['locale'] == 'en';
        session(['current_lang' => 'en']);
        return back();
    }

    public function getRoles()
    {
        $roles = Role::all();
        return return_msg(true, 'all roles', compact('roles'));
    }

    public function getAllCategories()
    {
        $categories = DrugCategory::all();
        return return_msg(true, 'getAllCategories', compact('categories'));
    }

    public function getAllManufacturer()
    {
        $manufacturers = Drug::distinct('manufacturer')->get(['manufacturer']);
        return return_msg(true, 'getAllManufacturer', compact('manufacturers'));
    }

    public function getAllStrength()
    {
        $strengths = Drug::distinct('strength')
                          ->get(['strength'])
                          ->where('strength','!=',NULL)
                          ->where('strength','!=','NA') 
                          ->values(); 
    //   Excel::create('strengths', function ($excel) use (&$strengths) {

    //         $excel->sheet('strengths', function ($sheet) use (&$strengths) { 
                
    //             $sheet->fromArray($strengths->toArray());
 
    //         });

    //     })->export('csv');
        return return_msg(true, 'getAllStrength', compact('strengths'));
    }

    public function getAllActiveIngredient()
    {
        $active_ingredients = Drug::distinct('active_ingredient')->get(['active_ingredient']);
        return return_msg(true, 'getAllActiveIngredient', compact('active_ingredients'));
    }

    public function getPaymentTypes()
    {
        $payment_types = PaymentType::all();
        return $payment_types;
    }

    public function getJobTypes()
    {
        $types = JobType::all();
        return $types;
    }

    public function getDrugs(Request $request)
    {
        return (new DrugController())->allDrugsFilteredStore($request);
    }

    public function getImageAdsTypes()
    {
        return ImageAdType::all();
    }

    public function getStoreSettings($store_id)
    {
        return StoreSettings::where('user_id', $store_id)->first();
    }

    public function getShareCode($q)
    {
        return Drug::where('pharmashare_code', 'LIKE', '%' . $q . '%')
            ->with('drugCategory')
            ->get();
    }
     
    public function getDrugsFromModel(Request $request)
    {
        $q = $request->drug_name;
        return  Drug::where('pharmashare_code', 'LIKE', '%' . $q . '%')
            ->orWhere('trade_name', 'LIKE', '%' . $q . '%')
            ->orWhere('active_ingredient', 'LIKE', '%' . $q . '%')
            ->orWhere('manufacturer', 'LIKE', '%' . $q . '%')
            ->with('drugCategory')
            ->get();
    }
    
    public function getDrugsLimited($limit = 100)
    { 
        return  Drug::limit($limit)
            ->with('drugCategory')
            ->get();
    }
    public function getDrugsCount()
    { 
        return  Drug::all()->count();
    }
}
