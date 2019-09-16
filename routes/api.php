<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('default-drug-sheet', 'Api\DrugController@generateDefaultExcelSheet')->name('api.getDefaultDrugsSheet');
Route::get('default-admin-drug-sheet', 'Api\DrugController@generateDefaultAdminExcelSheet')->name('api.getDefaultAdminDrugsSheet');

Route::post('update-unapproved-drug', 'Api\DrugController@updateUnApprovedDrug')->name('api.updateUnApprovedDrug');


Route::group(['prefix' => 'foc', 'namespace' => 'API'], function () {

    Route::post('create', 'FOCController@createFocGeneral');
    Route::post('activate-deactivate', 'FOCController@activateDeactivateFOC');
    Route::post('update', 'FOCController@updateFOC');
    Route::delete('delete/{id}', 'FOCController@deleteFOC');
});

Route::group(['prefix' => 'points', 'namespace' => 'API'], function () {

    Route::post('create', 'PointsController@create');
    Route::post('update', 'PointsController@update');
    Route::get('pharmacies-point', 'PointsController@getPharmaciesPoints');
    Route::get('pharmacies-point-admin', 'PointsController@getPharmaciesPointsForAdmin');


    Route::get('pharmacy-points', 'PointsController@getPharmacyPoints');
    Route::get('points-price', 'PointsController@getPointsPrice');
    Route::post('redeem-points', 'PointsController@redeemPoints');
});


Route::delete('delete-multi-drugs', 'Api\\DrugController@deleteMultipleDrugs');


Route::post('create-drug', 'Api\\DrugController@saveAdminMasterDrugs');
