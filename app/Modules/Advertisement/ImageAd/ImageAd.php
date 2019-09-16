<?php

namespace App\Modules\Advertisement\ImageAd;

use App\Models\ImageAd as ImageAdModel;
use App\Models\ImageAdType as ImageAdTypeModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ImageAd
{

    private $package;

    private $imageAdModel;

    private $imageAdTypeModel;

    private $storagePath;

    private $aws_path ;

    public function __construct()
    {

        $this->package = new Package();
        $this->imageAdModel = new ImageAdModel;
        $this->imageAdTypeModel = new ImageAdTypeModel;
        $this->storagePath = storage_path('imgs/');
        $this->aws_path = 'https://s3.amazonaws.com/pharmashare-files/';
    }


    public function createImageAd(array $data)
    {

        if (!$this->imageAdTypeModel->find($data['image_ad_type_id'])) {

            return return_msg(false, 'Not found', [
                'image_ad_type_found' => false,
                'validation_errors' => [],
            ]);
        }

        $package_id = $data['image_package_id'] ?? null;
        $response = $this->package->findPackage($package_id);

        if (!$response['status']) {

            return $response;
        }

        $package = $response['data']['package'];
        unset($response);

        $data['valid_until'] = Carbon::now()->addDays($package->period_in_days)->toDateString();
        $this->storeFiles($data);

        if (auth()->check() && auth()->user()->role->title === 'admin') {
            $data['approved'] = 1;
            $data['created_by_admin'] = 1;
        }

        $package->ads()->create($data);

        return return_msg(true, 'ok');
    }


    public function storeFiles(&$data)
    {

        $original_image = $data['original_image'] ?? null;
        $scaled_image = $data['scaled_image'] ?? null;
        $second_image = $data['second_image'] ?? null;
        $third_image = $data['third_image'] ?? null;

        $data['original_image'] = $this->uploadFile($original_image);
        $data['scaled_image'] = $this->uploadFile($scaled_image);
        $data['second_image'] = $this->uploadFile($second_image);
        $data['third_image'] = $this->uploadFile($third_image);

    }


    public function uploadFile($file, $disk = null)
    {

        if (!$file) {
            return;
        }

//        $file_name = uniqid() . '.' . $file->extension();

        $file = $this->uploadFileToS3($file);
        $file_name = $this->aws_path.$file;

//        $file->move(storage_path('imgs'), $file_name);

        return $file_name;
    }


    public function approveOrRejectAd($ad_id, bool $approve)
    {
        $ad = $this->imageAdModel->find($ad_id);

        if (!$ad) {

            return return_msg(false, 'Not Found');
        }

        $ad->update(['approved' => intval($approve)]);

        return return_msg(true, 'ok');
    }


    public function payImageAd($ad_id, array $data = [])
    {


        $response = $this->getAd($ad_id);
        if (!$response['status']) {

            return $response;
        }

        $image_ad = $response['data']['ad'];
        unset($response);


        // handle payment


        $image_ad->update(['paid_at' => Carbon::now()]);

        return return_msg(true, 'ok');
    }

    public function getAd($ad_id)
    {
        $ad = $this->imageAdModel
            ->with(['type', 'package', 'user'])
            ->find($ad_id);

        if (!$ad) {

            return return_msg(false, 'Not Found');
        }

        return return_msg(true, 'ok', compact('ad'));
    }

    public function updateImageAd(array $data)
    {

        if (!$this->imageAdTypeModel->find($data['image_ad_type_id'])) {

            return return_msg(false, 'Not found', [
                'image_ad_type_found' => false,
                'validation_errors' => [],
            ]);
        }

        $package_id = $data['image_package_id'] ?? null;
        $response = $this->package->findPackage($package_id);

        if (!$response['status']) {

            return $response;
        }
        unset($response);

        $ad_id = $data['ad_id'];
        $response = $this->getAd($ad_id);
        if (!$response['status']) {

            return $response;
        }

        $image_ad = $response['data']['ad'];
        unset($response);

        if (isset($data['valid_until'])) {
            unset($data['valid_until']);
        }

        $this->storeFilesForUpdate($data, $image_ad);

        $image_ad->update($data);

        return return_msg(true, 'ok');
    }

    public function storeFilesForUpdate(&$data, $image_ad)
    {

        if (isset($data['original_image'])) {

            $file = $data['original_image'];
//            $filePath = '/imgs/';
//            Storage::disk('s3')->delete($filePath . $image_ad->original_image);
//            Storage::disk('s3')->delete($filePath . $image_ad->second_image);

            Storage::disk('s3')->delete($image_ad->original_image);
            Storage::disk('s3')->delete($image_ad->second_image);

//            @unlink(storage_path('imgs/') . $image_ad->original_image);
//            @unlink(storage_path('imgs/') . $image_ad->second_image);

            $ratiod_file = $data['second_image'] ?? null;
            $data['original_image'] = $this->uploadFile($file);
            $data['second_image'] = $this->uploadFile($ratiod_file);
        }

        if (isset($data['scaled_image'])) {

            $file = $data['scaled_image'];
//            $filePath = '/imgs/';
//            Storage::disk('s3')->delete($filePath . $image_ad->scaled_image);
//            Storage::disk('s3')->delete($filePath . $image_ad->third_image);
            Storage::disk('s3')->delete($image_ad->third_image);
            Storage::disk('s3')->delete($image_ad->scaled_image);

            Storage::disk('s3')->delete($image_ad->scaled_image);
            Storage::disk('s3')->delete($image_ad->third_image);

//            @unlink(storage_path('imgs/') . $image_ad->scaled_image);
//            @unlink(storage_path('imgs/') . $image_ad->third_image);

            $ratiod_file = $data['third_image'] ?? null;
            $data['scaled_image'] = $this->uploadFile($file);
            $data['third_image'] = $this->uploadFile($ratiod_file);
        }
    }


    public function uploadFileToS3($file_name)
    {

        $file_name = $file_name->store(
            'imgs',
            's3'
        );

        return $file_name;
//
//        $s3 = Storage::disk('s3');
//        $filePath = '/imgs/' . $file_name;
//        $s3->put($filePath, file_get_contents($file_name), 'public');
    }

    public function getAllAdsCategorized()
    {

        $ads = $this->getAllAds()['data']['ads'];
        $ads = $ads
            ->where('approved', 1)
            ->where('paid_at', '!=', null)
            ->where('open', 1);

        $first_ratio = [];
        $second_ratio = [];

        foreach ($ads as $ad) {

            if ($ad->second_image_ratio) {
                $first_ratio[] = [
                    'display_for' => $ad->type->display_for ?? null,
                    'original_image' => $ad->original_image,
                    'second_image' => $ad->second_image,
                    'second_image_ratio' => $ad->second_image_ratio,
                    'link' => $ad->link
                ];
            }

            if ($ad->third_image_ratio) {
                $second_ratio[] = [
                    'display_for' => $ad->type->display_for ?? null,
                    'scaled_image' => $ad->scaled_image,
                    'third_image' => $ad->third_image,
                    'third_image_ratio' => $ad->third_image_ratio,
                    'link' => $ad->link
                ];
            }
        }

        shuffle($first_ratio);
        shuffle($second_ratio);

        return return_msg(true, 'ok', compact('first_ratio', 'second_ratio'));
    }

    public function getAllAds($approved = null)
    {

        $ads = $this->imageAdModel
            ->orderBy('show_queue')
            ->with(['type', 'package', 'user'])
            ->get();

        if ($approved) {
            switch ($approved) {
                case 0:
                    $ads = $ads->where('approved',0);
                    break;
                case 1:
                    $ads = $ads->where('approved',1);
                    break;
            }
        }

        // update showed ads queue
        $this->updateShowedAdsQueue($ads);

        return return_msg(true, 'ok', compact('ads'));
    }

    protected function updateShowedAdsQueue($ads)
    {
        foreach ($ads as $ad) {
            $ad->increment('show_queue');
        }
    }

    public function specifyUserSeesAd($ad_id, $type_id)
    {

        $ad = $this->imageAdModel->find($ad_id);

        if (!$ad) {

            return return_msg(false, 'Not Found');
        }

        $ad->update(['image_ad_type_id' => $type_id]);

        return return_msg(true, 'ok');
    }

    public function getUserAds($user_id)
    {

        $ads = $this->imageAdModel
            ->with(['type', 'package', 'user'])
            ->whereUserId($user_id)
            ->get();

        return return_msg(true, 'ok', compact('ads'));
    }


    public function deleteAd($ad_id)
    {
        $ad = $this->imageAdModel->find($ad_id);

        if (!$ad) {

            return return_msg(false, 'Not Found');
        }

//        Storage::disk('s3')->delete('folder_path/' . $ad->origin_image);
//        Storage::disk('s3')->delete('folder_path/' . $ad->second_image);
//        Storage::disk('s3')->delete('folder_path/' . $ad->third_image);
        Storage::disk('s3')->delete($ad->original_image);
        Storage::disk('s3')->delete($ad->scaled_image);
        Storage::disk('s3')->delete($ad->second_image);
        Storage::disk('s3')->delete($ad->third_image);

        $ad->delete();

        return return_msg(true, 'ok', compact('ad'));
    }


    public function hideOrShowAd($image_ad_id, $show)
    {

        $image_ad = $this->imageAdModel->find($image_ad_id);
        if (!$image_ad) {

            return return_msg(false, 'Not Found');
        }

        $image_ad->update(['open' => $show]);

        return return_msg(true, 'ok');
    }


    public function deleteExpiredAds()
    {

        $now = date('Y-m-d');
        $this->imageAdModel->where('valid_until', '<', $now)->delete();

        return 'SUCCESS';
    }

}