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

Route::get('/', 'ShopsController@index')->name('listingShops');

Auth::routes();

Route::get('/home', 'ShopsController@index')->name('home');

Route::get('/like', 'ShopsController@like')->name('like');

Route::get('/nearby', 'ShopsController@nearby');
