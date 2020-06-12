<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'Api\ApiController@authenticate');
Route::post('register', 'Api\ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/logout', 'Api\ApiController@logout');
    Route::get('/user', 'Api\ApiController@loggedUser');
    // Product Route
    Route::match(['get', 'post'], 'products_search', 'Api\ProductController@index');
    Route::get('products/{id}', 'Api\ProductController@show');
    Route::get('/productsdate/{date}', 'Api\ProductController@ShowByDate');
    Route::post('products', 'Api\ProductController@store');
    Route::put('products/{id}', 'Api\ProductController@update');
    Route::delete('products/{id}', 'Api\ProductController@destroy');

    //Town Route
    Route::match(['get','post'],'towns_search','Api\TownController@index');
    Route::post('towns','Api\TownController@store');

    //Type Route
    Route::match(['get','post'],'types_search','Api\TypeController@index');
    Route::post('types','Api\TypeController@store');
});
