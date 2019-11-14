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
//Route::resource('ajax-crud', 'NameController');
//Route::resource('/', 'NameController');

Route::get('/', 'NameController@index')->name('index');
Route::get('create', 'NameController@create');
Route::post('/', 'NameController@store')->name('store');
Route::delete('/{id}', 'NameController@destroy')->name('delete');

//Route::get('/{numberOfWinners}', 'SelectWinnersController@show')->name('show');
Route::get('/{numberOfWinners}', ['as' => 'show', 'uses' => 'SelectWinnersController@show']);