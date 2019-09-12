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