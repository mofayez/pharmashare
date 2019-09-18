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


Route::group(['prefix' => 'foc', 'namespace' => 'Api'], function () {

    Route::post('create', 'FOCController@createFocGeneral');
    Route::post('activate-deactivate', 'FOCController@activateDeactivateFOC');
    Route::post('update', 'FOCController@updateFOC');
    Route::delete('delete/{id}', 'FOCController@deleteFOC');
    Route::get('all-store-foc/{id}', 'FOCController@allDrugStoreFocByStoreId');
});

Route::group(['prefix' => 'points', 'namespace' => 'Api'], function () {

    Route::post('create', 'PointsController@create');
    Route::post('update', 'PointsController@update');
    Route::get('pharmacies-points', 'PointsController@getPharmaciesPoints');
    Route::get('pharmacies-points-admin', 'PointsController@getPharmaciesPointsForAdmin');


    Route::get('pharmacy-points', 'PointsController@getPharmacyPoints');
    Route::get('points-price', 'PointsController@getPointsPrice')->name('getPointsPriceAPI');
    Route::post('redeem-points', 'PointsController@redeemPoints');
    Route::get('points/{store_id}', 'PointsController@allPointsPackagesByStoreId');
});

Route::get('drug-store/{id}', 'Api\\DrugController@findDrugStore');

Route::delete('delete-multi-drugs', 'Api\\DrugController@deleteMultipleDrugs');


Route::post('create-drug', 'Api\\DrugController@saveDrug');
Route::post('update-drug', 'Api\\DrugController@updateDrugStore');
