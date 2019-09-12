<?php

namespace App\Modules\Advertisement;

use App\Modules\Advertisement\PackageAd\Package;
use App\Modules\Advertisement\PackageAd\PackageAd;
use App\Modules\Advertisement\ImageAd\Package as ImagePackage;
use App\Modules\Advertisement\ImageAd\ImageAd;

class Advertisement
{

    private $package;

    private $packageAd;

    private $image_package;

    private $image_ad;


    public function __construct()
    {

        $this->package = new Package();
        $this->packageAd = new PackageAd();
        $this->image_package = new ImagePackage();
        $this->image_ad = new ImageAd();
    }

    public function createPackageAd($data)
    {

        return $this->packageAd->createDrugsPackage($data);
    }

    public function updatePackageAd($data)
    {

        return $this->packageAd->updateDrugsPackage($data);
    }

    public function getUserPackages($store_id)
    {

        return $this->packageAd->getUserPackages($store_id);
    }


    public function getAllPackageUser()
    {
        return $this->packageAd->getAllPackageUser();
    }

    public function cancelDrugPackage($user_package_id)
    {

        return $this->packageAd->cancelDrugPackage($user_package_id);
    }

    public function getPackageUser($user_package_id)
    {

        return $this->packageAd->getPackageUser($user_package_id);
    }

    public function savePackage($data)
    {

        return $this->package->savePackage($data);
    }

    public function findPackage($id)
    {

        return $this->package->findPackage($id);
    }

    public function allPackages()
    {

        return $this->package->allPackages();
    }

    public function delete($id)
    {

        return $this->package->deletePackage($id);
    }

    public function saveImagePackage(array $data)
    {

        return $this->image_package->savePackage($data);
    }

    public function findImagePackage($id)
    {

        return $this->image_package->findPackage($id);
    }

    public function allImagePackages()
    {

        return $this->image_package->allPackages();
    }

    public function deleteImagePackage($id)
    {

        return $this->image_package->deletePackage($id);
    }

    public function createImagePackageAd(array $data)
    {

        return $this->image_ad->createImageAd($data);
    }

    public function allImageAds($approved = null)
    {

        return $this->image_ad->getAllAds($approved);
    }

    public function approveOrRejectAd($ad_id, bool $approve)
    {

        return $this->image_ad->approveOrRejectAd($ad_id, $approve);
    }

    public function getImageAd($id)
    {

        return $this->image_ad->getAd($id);
    }

    public function getUserImageAds($user_id)
    {

        return $this->image_ad->getUserAds($user_id);
    }

    public function deleteExpiredImageAds()
    {

        return $this->image_ad->deleteExpiredAds();
    }

    public function updateImageAd(array $data)
    {

        return $this->image_ad->updateImageAd($data);
    }

    public function hideOrShowAd($image_ad_id, $show)
    {

        return $this->image_ad->hideOrShowAd($image_ad_id, $show);
    }

    public function specifyUserSeesAd($ad_id, $type_id)
    {

        return $this->image_ad->specifyUserSeesAd($ad_id, $type_id);
    }

    public function payImageAd($ad_id, array $data = [])
    {

        return $this->image_ad->payImageAd($ad_id, $data);
    }

    public function getAllAdsCategorized()
    {

        return $this->image_ad->getAllAdsCategorized();
    }
}