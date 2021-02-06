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
Route::get('collection','CollectTuto@index');

################## Collection each ###################

Route::get('collection','CollectTuto@index');
Route::get('each-collection','CollectTuto@complex');

################## Collection filter ###################

Route::get('filter-collection','CollectTuto@complexFilter');

################## Collection transform ###################

Route::get('collection_transform','CollectTuto@complexTransform');








