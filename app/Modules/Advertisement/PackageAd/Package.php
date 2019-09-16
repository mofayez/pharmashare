<?php

namespace App\Modules\Advertisement\PackageAd;

use App\Models\Package as PackageModel;


class Package
{

    /**
     * @var PackageModel
     */
    private $packageModel;


    public function __construct()
    {
        $this->packageModel = new PackageModel;
    }


    public function savePackage(array $data)
    {

        $this->packageModel->updateOrCreate(
            ['id' => $data['package_id'] ?? null],
            $data
        );

        return return_msg(true, 'ok');
    }


    public function allPackages()
    {

        $packages = $this->packageModel->all();

        return return_msg(true, 'ok', compact('packages'));
    }


    public function findPackage($id)
    {

        $package = $this->packageModel->find($id);
        if (!$package) {

            return return_msg(false, 'Not found');
        }

        return return_msg(true, 'ok', compact('package'));
    }


    public function deletePackage($id)
    {

        $package = $this->packageModel->find($id);
        if (!$package) {

            return return_msg(false, 'Not found', [
                'hasAds' => false
            ]);
        }

        if (count($package->packageUser) > 0) {

            return return_msg(false, 'has adds', [
                'hasAds' => true
            ]);
        }

        $package->delete();
        return return_msg(true, 'ok');
    }



}