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

//Route::get('/', 'NameController@index');
Route::resource('ajax-crud', 'NameController');

Route::get('/', 'NameController@index');
Route::get('create', 'NameController@create');
Route::post('/', 'NameController@store')->name('store');
