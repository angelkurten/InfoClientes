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

Route::apiResource('clients', 'ClientsController');
Route::apiResource('visits', 'VisitController');
Route::apiResource('countries', 'CountryController')->only('index');
Route::apiResource('sellers', 'SellerController')->only('index');
Route::apiResource('states', 'StateController')->only('show');
Route::apiResource('cities', 'CityController')->only(['show', 'index']);
