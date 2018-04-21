<?php

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
Route::resource('businesscategory','BusinessCategoryController');
//Route::resource('shop_categories','Shop_categoriesController');
//商家信息
Route::resource('businessusers','BusinessUsersController');
Route::resource('businessd','BusinessDetailsController');
Route::resource('admin','AdminsController');
Route::get('login','LoginController@index')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::get('form/{admin}','CheckController@show')->name('form');
Route::post('update/{admin}','CheckController@update')->name('check.update');
Route::get('status/{businessuser}/check','BusinessUsersController@check')->name('status.check');
