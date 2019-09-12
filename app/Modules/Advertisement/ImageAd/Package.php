<?php

namespace App\Modules\Advertisement\ImageAd;

use App\Models\ImagePackage as ImagePackageModel;


class Package
{

    /**
     * @var ImagePackageModel
     */
    private $imagePackageModel;


    public function __construct()
    {
        $this->imagePackageModel = new ImagePackageModel;
    }


    public function savePackage(array $data)
    {

        $this->imagePackageModel->updateOrCreate(
            ['id' => $data['package_id'] ?? null],
            $data
        );

        return return_msg(true, 'ok');
    }


    public function allPackages()
    {

        $packages = $this->imagePackageModel->all();

        return return_msg(true, 'ok', compact('packages'));
    }


    public function findPackage($id)
    {

        $package = $this->imagePackageModel->find($id);
        if (!$package) {

            return return_msg(false, 'Not found', [
                'image_package_id' => false
            ]);
        }

        return return_msg(true, 'ok', compact('package'));
    }


    public function deletePackage($id)
    {

        $package = $this->imagePackageModel->find($id);
        if (!$package) {

            return return_msg(false, 'Not found', [
                'hasAds' => false
            ]);
        }

        if (count($package->ads) > 0) {

            return return_msg(false, 'has adds', [
                'hasAds' => true
            ]);
        }


        $package->delete();
        return return_msg(true, 'ok');
    }



}