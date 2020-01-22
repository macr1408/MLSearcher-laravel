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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@index')->name('view_search');
Route::post('/search', 'SearchController@create')->name('create_search');

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::get('/settings', 'Users\SettingsController@index')->name('view_settings');
    Route::post('/settings', 'Users\SettingsController@index')->name('create_settings');
    Route::put('/settings', 'Users\SettingsController@index')->name('update_settings');
});
