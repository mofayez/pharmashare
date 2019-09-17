<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Drug\FOCPoints;
use Illuminate\Http\Request;

class PointsController extends Controller
{


    protected $focPointsPackage;
    protected $focPoints;


    public function __construct()
    {

        $this->focPointsPackage = new FOCPoints();
        $this->focPoints = new FOCPoints();
    }


    public function create(Request $request)
    {

        $validation = validator($request->all(), [
            'store_id' => 'required',
            'points.*' => 'required|numeric',
            'price.*' => 'required|numeric',
            'points' => 'required|array',
            'price' => 'required|array'
        ]);

        if ($validation->fails()) {


            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->focPointsPackage->savePointsPackages($request->all());
    }

    public function update(Request $request)
    {

        $validation = validator($request->all(), [
            'package_id' => 'required',
            'store_id' => 'required',
            'points' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($validation->fails()) {


            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->focPointsPackage->updatePointsPackage($request->all());
    }


    public function getPharmaciesPoints(Request $request)
    {

        $store_id = $request->store_id;
        $pharmacy_id = $request->pharmacy_id;
        $pharmacy_name = $request->pharmacy_name;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $validation = validator($request->all(), [
            'store_id' => 'required|exists:users,id'
        ]);

        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->focPoints->getPharmaciesPoints(
            compact(
                'store_id', 'pharmacy_id', 'pharmacy_name', 'from_date', 'to_date'
            ));
    }

    public function getPharmaciesPointsForAdmin(Request $request)
    {

        $store_id = $request->store_id;
        $pharmacy_id = $request->pharmacy_id;
        $pharmacy_name = $request->pharmacy_name;
        $from_date = $request->from_date;
        $to_date = $request->to_date;


        return $this->focPoints->getPharmaciesPoints(
            compact(
                'store_id', 'pharmacy_id', 'pharmacy_name', 'from_date', 'to_date'
            ));
    }


    public function getPharmacyPoints(Request $request)
    {

        $validation = validator($request->all(), [
            'pharmacy_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:users,id'
        ]);

        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->focPoints->getPharmacyPoints($request->all());
    }


    public function getPointsPrice(Request $request)
    {

        $validation = validator($request->all(), [
            'total_points_with_pharmacy' => 'required|numeric',
            'store_id' => 'required|exists:users,id'
        ]);

        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->focPoints->getPointsPrice($request->all());
    }


    public function redeemPoints(Request $request)
    {

        $validation = validator($request->all(), [
            'points_package_id' => 'required|exists:store_points_packages,id',
            'pharmacy_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:users,id'
        ]);

        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->focPoints->redeemPoints($request->all());
    }
}
