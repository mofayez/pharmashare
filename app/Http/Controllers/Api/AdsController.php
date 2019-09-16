<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\traits\AdValidationsTrait;
use App\Modules\Advertisement\Advertisement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdsController extends Controller
{

    use AdValidationsTrait;

    private $ad;


    public function __construct()
    {
        $this->ad = new Advertisement();
    }


    public function createPackageAd(Request $request)
    {

        $validation = $this->validateCreatePackageUserRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
                'no_sufficient_package_found' => false,
                'not_found_package_store_ids' => []
            ]);
        }

        $response = $this->ad->createPackageAd($request->all());

        return $response;
    }

    public function updatePackageAd(Request $request)
    {

        $validation = $this->validateUpdatePackageUserRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => [],
                'package_user_not_found' => true,
                'not_found_package_store_ids' => []
            ]);
        }

        $response = $this->ad->updatePackageAd($request->all());

        return $response;
    }

    public function getUserPackages($store_id)
    {

        return $this->ad->getUserPackages($store_id);
    }

    public function cancelDrugPackage($package_user_id)
    {

        return $this->ad->cancelDrugPackage($package_user_id);
    }

    public function getPackageUser($package_user_id)
    {

        return $this->ad->getPackageUser($package_user_id);
    }

    public function getAllPackageUser()
    {

        return $this->ad->getAllPackageUser();
    }

    public function createPackage(Request $request)
    {

        $validation = $this->validateCreatePackageRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $response = $this->ad->savePackage($request->all());

        return $response;
    }

    public function updatePackage(Request $request)
    {

        $validation = $this->validateUpdatePackageRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $package = $this->ad->findPackage($request->package_id);
        if (!$package['status']) {

            return $package;
        }

        $response = $this->ad->savePackage($request->all());

        return $response;
    }

    public function allPackages()
    {

        return $this->ad->allPackages();
    }


    public function getPackage($id)
    {

        return $this->ad->findPackage($id);
    }

    public function deletePackage($id)
    {

        return $this->ad->delete($id);
    }


    public function createImagePackage(Request $request)
    {

        $request_data = $request->all();
        unset($request);

        $validation = $this->validateCreateImagePackageRequest($request_data);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'image_ad_type_found' => true,
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->ad->saveImagePackage($request_data);
    }


    public function updateImagePackage(Request $request)
    {

        $request_data = $request->all();
        unset($request);

        $validation = $this->validateUpdateImagePackageRequest($request_data);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'image_ad_type_found' => true,
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $package = $this->ad->findImagePackage($request_data['package_id']);
        if (!$package['status']) {

            return $package;
        }

        return $this->ad->saveImagePackage($request_data);
    }

    public function getImagePackage($id)
    {

        return $this->ad->findImagePackage($id);
    }

    public function allImagePackages()
    {

        return $this->ad->allImagePackages();
    }

    public function deleteImagePackage($id)
    {

        return $this->ad->deleteImagePackage($id);
    }

    public function createImageAd(Request $request)
    {

        $request_data = $request->all();
        unset($request);

        $validation = $this->validateCreateImageAdRequest($request_data);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'image_package_id' => true,
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->ad->createImagePackageAd($request_data);
    }

    public function allImageAds($approved = null)
    {

        return $this->ad->allImageAds($approved);
    }

    public function approveOrRejectAd($ad_id, bool $approve)
    {

        return $this->ad->approveOrRejectAd($ad_id, $approve);
    }

    public function getImageAd($id)
    {

        return $this->ad->getImageAd($id);
    }

    public function getUserImageAds($user_id)
    {

        return $this->ad->getUserImageAds($user_id);
    }

    public function deleteExpiredImageAds()
    {

        return $this->ad->deleteExpiredImageAds();
    }

    public function updateImageAd(Request $request)
    {

        $request_data = $request->all();
        $validation = $this->validateUpdateImageAdRequest($request_data);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->ad->updateImageAd($request_data);
    }


    public function hideOrShowAd($image_ad_id, $show)
    {

        return $this->ad->hideOrShowAd($image_ad_id, $show);
    }

    public function specifyUserSeesAd($ad_id, $type_id)
    {

        return $this->ad->specifyUserSeesAd($ad_id, $type_id);
    }

    public function payImageAd($ad_id, array $data = [])
    {

        return $this->ad->payImageAd($ad_id, $data);
    }

    public function getAllAdsCategorized()
    {

        return $this->ad->getAllAdsCategorized();
    }


}
