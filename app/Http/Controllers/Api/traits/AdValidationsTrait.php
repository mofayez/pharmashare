<?php


namespace App\Http\Controllers\Api\traits;


use Illuminate\Http\Request;

trait AdValidationsTrait
{


    function validateCreatePackageUserRequest(Request $request)
    {

        return validator($request->all(), [
            'drug_store_ids' => 'required',
            'user_id' => 'required',
        ]);
    }


    function validateUpdatePackageUserRequest(Request $request)
    {

        return validator($request->all(), [
            'user_package_id' => 'required',
            'drug_store_ids' => 'required',
        ]);
    }


    function validateCreatePackageRequest(Request $request)
    {

        return validator($request->all(), [
            'name' => 'required',
            'min_number_of_drugs' => 'required|numeric',
            'max_number_of_drugs' => 'required|numeric',
            'price' => 'required|numeric',
            'period_in_days' => 'required|numeric',
        ]);
    }


    function validateUpdatePackageRequest(Request $request)
    {

        return validator($request->all(), [
            'package_id' => 'required',
            'name' => 'required',
            'min_number_of_drugs' => 'required|numeric',
            'max_number_of_drugs' => 'required|numeric',
            'price' => 'required|numeric',
            'period_in_days' => 'required|numeric',
        ]);
    }

    function validateCreateImagePackageRequest($request_data)
    {

        return validator($request_data, [
            'name' => 'required',
            'price' => 'required',
            'period_in_days' => 'required'
        ]);
    }

    function validateUpdateImagePackageRequest($request_data)
    {

        return validator($request_data, [
            'package_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'period_in_days' => 'required'
        ]);
    }

    public function validateCreateImageAdRequest($request_data)
    {
        return validator($request_data, [
            'image_ad_type_id' => 'required',
            'image_package_id' => 'required',
            'user_id' => 'required',
            'link' => 'required',
            'original_image' => 'required_without:scaled_image',
            'scaled_image' => 'required_without:original_image',
        ]);
    }

    public function validateUpdateImageAdRequest($request_data)
    {
        return validator($request_data, [
            'image_ad_type_id' => 'required',
            'ad_id' => 'required',
            'image_package_id' => 'required',
            'user_id' => 'required',
            'link' => 'required',
            'original_image' => 'required_without:scaled_image',
            'scaled_image' => 'required_without:original_image',
        ]);
    }
}