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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Start Independent Routes
    Route::post('/importPlanRecordExcelFile', 'IndependentController@importPlanRecordExcelFile');
    Route::post('/importBrandsExcelFile', 'Api\IndependentController@inportBrandFromCSV');
// End Independent Routes