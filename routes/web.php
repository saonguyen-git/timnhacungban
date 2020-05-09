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

\Illuminate\Support\Facades\URL::forceScheme('https');

Route::get('/', 'HomeController@homePage');
Route::get('/home', 'HomeController@homePage');
Route::get('/get-position', 'HomeController@get_position');
Route::get('/search', 'HomeController@search');
Route::get('/api ', 'GetDataChototController@get_data_post');
Route::post('/api ', 'GetDataChototController@get_data_post');
Route::get('/viec-lam-sinh-vien ', 'HomeController@list_job');
Route::get('/{id}', 'HomeController@get_post');
Route::get('/phong-tro/{slug}/{id}', 'HomeController@get_detail');

