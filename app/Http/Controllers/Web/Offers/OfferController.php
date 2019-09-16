<?php

namespace App\Http\Controllers\Web\Offers;

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\DrugController;
use App\Http\Controllers\Api\DrugStoreController;
use App\Http\Controllers\Web\UtilityController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    private $offers;
    private $drugs;
    private $utility;

    public function __construct()
    {
        $this->offers = new AdsController();
        $this->drugs = new DrugController();
        $this->utility = new UtilityController();
    }

    public function getAddImageOffersView()
    {
        $page_title = "Offers";
        $nav = 1;
        $user = auth()->user();

        if ($user->role_id == 4) return back();

        $image_packages = [];
        $response2 = $this->offers->allImagePackages();
        if ($response2['status']) {
            $image_packages = $response2['data']['packages'];
        }

        $types = $this->utility->getImageAdsTypes();

        return view('pages.offers.addImageOffers.index', compact('page_title', 'user', 'nav', 'image_packages', 'types'));
    }

    public function getAddDrugsOffersView()
    {
        $page_title = "Offers";
        $nav = 2;
        $user = auth()->user();

        if ($user->role_id != 2) return back();

        $packages = [];
        $response = $this->offers->allPackages();
        if ($response['status']) {
            $packages = $response['data']['packages'];
        }

        $drugs = [];
        $response2 = $this->drugs->allDrugsStore($user->id);
        if ($response2['status']) {
            $drugs = $response2['data']['drugs'];
        }

        return view('pages.offers.addDrugsOffers.index', compact('page_title', 'user', 'nav', 'packages', 'drugs'));
    }

    public function getAllUserOffersView()
    {
        $page_title = "Offers";
        $nav = 3;
        $user = auth()->user();

        if ($user->role_id == 4) return back();

        $ads_features = [];
        $ads_images = [];
        $response = $this->offers->getUserPackages($user->id);
        if ($response['status']) {
            $ads_features = $response['data']['packages'];
        }
        $response2 = $this->offers->getUserImageAds($user->id);

        if ($response2['status']) {
            $ads_images = $response2['data']['ads'];
        }
//        return $ads_images;

        return view('pages.offers.allUserOffers.index', compact('page_title', 'user', 'nav', 'ads_images', 'ads_features'));
    }

    public function getOfferPackagesView()
    {
        $page_title = "Offers";
        $nav = 4;
        $user = auth()->user();

        if ($user->role_id != 1) return back();

        $packages = [];
        $response = $this->offers->allPackages();
        if ($response['status']) {
            $packages = $response['data']['packages'];
        }
        $image_packages = [];
        $response2 = $this->offers->allImagePackages();
        if ($response2['status']) {
            $image_packages = $response2['data']['packages'];
        }

        return view('pages.offers.offerPackages.index', compact('page_title', 'user', 'nav', 'packages', 'image_packages'));
    }

    public function getEditOfferPackagesView(Request $request, $id)
    {

        $page_title = "Offers";
        $nav = 4;
        $user = auth()->user();

        if ($user->role_id != 1) return back();

        $package = [];
        $response = $this->offers->getPackage($id);
        if ($response['status']) {
            $package = $response['data']['package'];
        }
        return view('pages.offers.editOfferPackages.index', compact('page_title', 'user', 'nav', 'package'));
    }

    public function getAddOfferPackagesView()
    {
        $page_title = "Offers";
        $nav = 6;
        $user = auth()->user();

        if ($user->role_id != 1) return back();

        return view('pages.offers.addOfferPackages.index', compact('page_title', 'user', 'nav'));
    }

    public function getAddOfferImagePackagesView()
    {
        $page_title = "Offers";
        $nav = 6;
        $user = auth()->user();

        if ($user->role_id != 1) return back();

        $types = $this->utility->getImageAdsTypes();

        return view('pages.offers.addOfferImagePackages.index', compact('page_title', 'user', 'nav', 'types'));
    }

    public function getEditOfferImagePackagesView(Request $request, $id)
    {

        $page_title = "Offers";
        $nav = 4;
        $user = auth()->user();

        if ($user->role_id != 1) return back();

        $types = $this->utility->getImageAdsTypes();

        $package = [];
        $response = $this->offers->getImagePackage($id);

        if ($response['status']) {
            $package = $response['data']['package'];
        }
        return view('pages.offers.editOfferImagePackages.index', compact('page_title', 'user', 'nav', 'types', 'package'));
    }

    public function getApproveOffersView()
    {
        $page_title = "Offers";
        $nav = 5;
        $user = auth()->user();

        if ($user->role_id != 1) return back();

        $ads = [];
        $response = $this->offers->allImageAds();
        if ($response['status']) {
            $ads = $response['data']['ads'];
        }

//        return $ads;

        return view('pages.offers.approveOffers.index', compact('page_title', 'user', 'nav', 'ads'));
    }

    public function getViewFeatureAdsView(Request $request, $id)
    {
        $page_title = "Offers";
        $nav = 2;
        $user = auth()->user();

        if ($user->role_id != 2) return back();

        $packages = [];
        $response = $this->offers->allPackages();
        if ($response['status']) {
            $packages = $response['data']['packages'];
        }

        $drugs = [];
        $response2 = $this->drugs->allDrugsStore($user->id);
        if ($response2['status']) {
            $drugs = $response2['data']['drugs'];
        }

        $package_user = [];
        $response = $this->offers->getPackageUser($id);
        if ($response['status']) {
            $package_user = $response['data']['package_user'];
        }

        $ids_objs = $package_user->details ?? [];
        $drug_ids = collect([]);
        foreach ($ids_objs as $obj) {
            $drug_ids->push($obj->drugStore->id);
        }

//        return $drug_ids;
        return view('pages.offers.editDrugsOffers.index', compact('page_title', 'drug_ids', 'user', 'nav', 'packages', 'drugs', 'package_user'));
    }

    public function getViewImageAdsView(Request $request, $id)
    {
        $page_title = "Offers";
        $nav = 1;
        $user = auth()->user();

        if ($user->role_id == 4) return back();

        $image_packages = [];
        $response2 = $this->offers->allImagePackages();
        if ($response2['status']) {
            $image_packages = $response2['data']['packages'];
        }

        $image_ads = [];
        $response = $this->offers->getImageAd($id);
        if ($response['status']) {
            $image_ads = $response['data']['ad'];
        }

        $types = $this->utility->getImageAdsTypes();
//        return $image_ads;
        return view('pages.offers.editImageOffers.index', compact('page_title', 'user', 'nav', 'image_packages', 'image_ads', 'types'));
    }


    public function uploadImagesAds(Request $request)
    {
        $request['user_id'] = auth()->user()->id;

        $original_image = $request->file('image');
        $scaled_image = $request->file('image2');
        $second_image = $request->file('size_2_1');
        $third_image = $request->file('size_16_9');

        $request['original_image'] = $original_image;
        $request['scaled_image'] = $scaled_image;
        $request['second_image'] = $second_image;
        $request['third_image'] = $third_image;


        return $this->offers->createImageAd($request);

    }

    public function uploadUpdateImagesAds(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $original_image = $request->file('image');
        $scaled_image = $request->file('image2');
        $second_image = $request->file('size_2_1');
        $third_image = $request->file('size_16_9');

        $request['original_image'] = $original_image;
        $request['scaled_image'] = $scaled_image;
        $request['second_image'] = $second_image;
        $request['third_image'] = $third_image;
        // $request['ad_id'] = $request->id;

        // return $request->all();
        return $this->offers->updateImageAd($request);

    }

    public function addDrugsItemsAds(Request $request)
    {
        $drug_store_ids = $request->drug_store_ids;
        $request['drug_store_ids'] = $drug_store_ids ?? [];
        $request['user_id'] = auth()->user()->id;

        $response = $this->offers->createPackageAd($request);
        if (!$response['status']) {
            if ($response['data']['no_sufficient_package_found']) {
                return back()->with('error', 'no_sufficient_package_found');
            }
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }

        return back()->with('success', __('settings.add_success'));
    }

    public function updateDrugsItemsAds(Request $request, $id)
    {
        $drug_store_ids = $request->drug_store_ids;
        $request['drug_store_ids'] = $drug_store_ids ?? [];
        $request['user_id'] = auth()->user()->id;
        $request['user_package_id'] = $id;

        $response = $this->offers->updatePackageAd($request);
        if (!$response['status']) {
            if ($response['data']['no_sufficient_package_found']) {
                return back()->with('error', 'no_sufficient_package_found');
            }
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }

        return back()->with('success', __('settings.edit_success'));
    }

    public function addAdsPackages(Request $request)
    {
        $response = $this->offers->createPackage($request);
        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }

        return back()->with('success', __('settings.add_success'));
    }

    public function addAdsImagePackages(Request $request)
    {
        $response = $this->offers->createImagePackage($request);
        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }

        return back()->with('success', __('settings.add_success'));
    }

    public function updateAdsPackages(Request $request, $id)
    {
        $request['package_id'] = $id;
        $response = $this->offers->updatePackage($request);
        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }
        return back()->with('success', __('settings.edit_success'));
    }

    public function updateAdsImagePackages(Request $request, $id)
    {
        $request['package_id'] = $id;
        $response = $this->offers->updateImagePackage($request);
        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }
        return back()->with('success', __('settings.edit_success'));
    }

    public function ShowOrHide(Request $request)
    {
        return $this->offers->hideOrShowAd($request->id, $request->type);
    }

    public function deleteAdsPackage(Request $request)
    {
        return $this->offers->deletePackage($request->id);
    }

    public function deleteAdsImagePackage(Request $request)
    {
        return $this->offers->deleteImagePackage($request->id);
    }

    public function approveAds(Request $request)
    {
        return $this->offers->approveOrRejectAd($request->id, true);
    }

    public function rejectAds(Request $request)
    {
        return $this->offers->approveOrRejectAd($request->id, false);
    }
}
