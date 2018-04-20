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