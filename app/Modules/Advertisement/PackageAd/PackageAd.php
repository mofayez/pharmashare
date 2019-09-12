<?php

namespace App\Modules\Advertisement\PackageAd;

use App\Models\DrugStore as DrugStoreModel;
use App\Models\Package as PackageModel;
use App\Models\PackageUser as PackageUserModel;
use App\Models\Status;
use App\Modules\Drug\Drug;
use App\Modules\DrugStore\DrugStore;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PackageAd
{


    private $drugStoreModel;

    private $packageModel;

    private $packageUserModel;

//    private $drugPackageModel;

    private $package;

    private $drug;

    private $status;

    private $drugStore;

    public function __construct()
    {

        $this->drugStoreModel = new DrugStoreModel;
        $this->packageModel = new PackageModel;
        $this->packageUserModel = new PackageUserModel;
        $this->status = new Status;
        $this->package = new Package();
        $this->drug = new Drug();
        $this->drugStore = new DrugStore();
    }


    public function createDrugsPackage(array $data)
    {

        $drug_store_ids = $data['drug_store_ids'] ?? [];
        $package_id = $data['package_id'] ?? null;
        $user_id = $data['user_id'];

        $non_existed_ids = $this->drug->returnNonExistedDrugStoreIds($drug_store_ids);
        if (count($non_existed_ids) > 0) {

            return return_msg(false, 'Not found', [
                'validation_errors' => [],
                'no_sufficient_package_found' => false,
                'not_found_package_store_ids' => $non_existed_ids
            ]);
        }

        if ($package_id) {
            $package = $this->packageModel->find($package_id);
        } else {
            $package = $this->getProperPackage(count($drug_store_ids));
        }

        if (!$package) {

            return return_msg(false, 'No Sufficient Package Found', [
                'validation_errors' => [],
                'no_sufficient_package_found' => true,
                'not_found_package_store_ids' => []
            ]);
        }

        DB::beginTransaction();
        try {

            $package_user = $package->packageUser()->create([
                'user_id' => $user_id,
                'valid_until' => Carbon::now()->addDays($package->period_in_days)->toDateString(),
                'status_id' => $this->getStatus('paid')->id
            ]);

            $package_user->details()->createMany($this->preparePackageUserDetailsData($package_user->id, $drug_store_ids));

        } catch (\Exception $exception) {

            dd('Internal Server Error', $exception->getMessage());
        }
        DB::commit();

        return return_msg(true, 'ok');
    }

    public function getProperPackage($numberOfDrugs)
    {
        $package = $this->packageModel
            ->where('min_number_of_drugs', '<=', $numberOfDrugs)
            ->where('max_number_of_drugs', '>=', $numberOfDrugs)
            ->first();

        return $package;
    }

    public function getStatus($title, $type = 'package')
    {

        $status = $this->status->whereTitle($title)
            ->whereType($type)
            ->first();

        return $status;
    }

    protected function preparePackageUserDetailsData($package_user_id, $drugs_ids)
    {

        $data = [];
        foreach ($drugs_ids as $drugs_id) {
            $data[] = [
                'package_user_id' => $package_user_id,
                'drug_store_id' => $drugs_id
            ];
        }

        return $data;
    }

    public function payPackageAd($ad_id, array $data = [])
    {


        $package_ad = $this->packageUserModel->find($ad_id);
        if (!$package_ad) {

            return return_msg(false, 'Not Found');
        }


        // handle payment


        $package_ad->update(['paid_at' => Carbon::now()]);

        return return_msg(true, 'ok');
    }

    public function updateDrugsPackage(array $data)
    {

        $user_package_id = $data['user_package_id'];
        $drug_store_ids = $data['drug_store_ids'] ?? [];

        $package_user = $this->packageUserModel->find($user_package_id);
        if (!$package_user) {

            return return_msg(false, 'Not Found', [
                'validation_errors' => [],
                'package_user_not_found' => true,
                'not_found_package_store_ids' => []
            ]);
        }

        $non_existed_ids = $this->drug->returnNonExistedDrugStoreIds($drug_store_ids);
        if (count($non_existed_ids) > 0) {

            return return_msg(false, 'Not found', [
                'validation_errors' => [],
                'not_valid_package' => false,
                'not_found_package_store_ids' => $non_existed_ids
            ]);
        }

        $package = $package_user->package;

        $is_proper_package = $this->isProperPackage($package, count($drug_store_ids));
        if (!$is_proper_package) {
            return return_msg(false, 'Not found', [
                'validation_errors' => [],
                'not_valid_package' => true,
                'not_found_package_store_ids' => []
            ]);
        }

        DB::beginTransaction();
        try {

            $package_user->details()->delete();
            $package_user->details()->createMany($this->preparePackageUserDetailsData($package_user->id, $drug_store_ids));

        } catch (\Exception $exception) {

            dd('Internal Server Error', $exception->getMessage());
        }
        DB::commit();

        return return_msg(true, 'ok', [
            'proper_package' => $package_user
        ]);
    }

    public function isProperPackage($package, $numberOfDrugs)
    {

        return $package->min_number_of_drugs <= $numberOfDrugs && $package->max_number_of_drugs >= $numberOfDrugs;
    }

    public function getUserPackages($store_id)
    {

        return $this->drugStore->getPackages($store_id);
    }

    public function cancelDrugPackage($user_package_id)
    {

        $package_user = $this->packageUserModel->find($user_package_id);
        if (!$package_user) {

            return return_msg(false, 'Not Found');
        }

        $package_user->delete();

        return return_msg(true, 'ok');
    }

    public function getPackageUser($package_user_id)
    {

        $package_user = $this->packageUserModel->with(['package', 'details.drugStore.drug'])->find($package_user_id);
        if (!$package_user) {

            return return_msg(false, 'Not Found');
        }

        $package_user->isPaid = $package_user->isPaid();

        return return_msg(true, 'ok', compact('package_user'));
    }


    public function getAllPackageUser()
    {

        $packages = $this->packageUserModel->with(['package', 'details.drugStore.drug'])->all();

        foreach ($packages as $package) {

            $package->isPaid = $package->isPaid();
        }

        return return_msg(true, 'ok', compact('packages'));
    }
}