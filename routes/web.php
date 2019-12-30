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
Route::get('/authorize', 'AuthController@index');
Route::get('/{pash}', 'ApiController@index')->where('path','.*');
Route::post('/authorize', 'AuthController@index')->name('login');
Route::group(['middleware' => 'cors','prefix' => 'api'], function(){
    Route::get('shop', 'AdminController@index');
    Route::post('settings/save', 'AdminController@save');
    Route::post('add', 'ApiController@add');
    Route::post('remove', 'ApiController@remove');
    Route::get('select/{shopUrl}/{customerId}', 'ApiController@select');
    Route::get('getRecentlyViewed/{shopUrl}/{customerId}', 'ApiController@getRecentlyViewed');
    Route::get('dashboard', 'ApiController@dashboard');
    Route::get('dashboard', 'ApiController@dashboard');
    Route::get('/{month}', 'ApiController@month');
});

