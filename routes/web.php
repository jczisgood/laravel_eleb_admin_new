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

//Route::get('/', function () {
//    return view('welcome');
//});
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
Route::get('myself/{admin}','CheckController@edit')->name('myself');
Route::post('update/{admin}','CheckController@update')->name('check.update');
Route::post('updatemyself/{admin}','CheckController@update2')->name('check.updatemyself');
Route::get('status/{businessuser}/check','BusinessUsersController@check')->name('status.check');
Route::resource('activity','ActivityController');
Route::post('/set','PicController@create');
Route::get('foodcount','FoodCountController@index')->name('foodcount')->middleware('permission:foodcount');
Route::get('/www','WwwController@index');
Route::resource('/permission','PermissionsController');
Route::resource('/role','RolesController');
Route::resource('/menu','MenuController');
Route::resource('event','EventController');
Route::resource('eventprize','EventPrizeController');
Route::get('showgoods/{event}/goods','EventController@showgoods')->name('event.showgoods');
Route::get('take/{event}','EventController@take')->name('event.take');
Route::get('see/{event}','EventController@see')->name('event.see');
