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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/bunche', 'BuncheController@index');

Route::resource('template', 'TemplateController');
Route::resource('bunche', 'BuncheController');
Route::resource('campaign', 'CampaignController');

Route::get('campaign/{campaign}/preview', 'CampaignController@preview')->name('campaign.preview');
Route::post('campaign/{campaign}/send', 'CampaignController@send')->name('campaign.send');

Route::prefix('bunche/{bunche}')->group(function () {
	Route::resource('subscriber', 'SubscriberController');
});