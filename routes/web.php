<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ajaxproducts','ProductAjaxController');
Route::get('ajaxdata', 'AjaxdataController@index')->name('ajaxdata');
Route::get('ajaxdata/getdata', 'AjaxdataController@getdata')->name('ajaxdata.getdata');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function (){
    Route::resource('products','Admin\ProductAdminController');
    Route::resource('towns','Admin\TownAdminController');
    Route::resource('types','Admin\TypeAdminController');
    Route::resource('ajaxproducts','ProductAjaxController');
});

