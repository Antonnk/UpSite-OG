<?php

Route::domain('{slug}.'.env('APP_DOMAIN'))->group(function () {
    Route::get('/','SiteController@show')->middleware('cacheResponse');
});

Route::post('/sites', 'SiteController@store');
Route::delete('/sites/{slug}', 'SiteController@destroy');
Route::put('/sites/{slug}/claim', 'SiteController@claim');
Route::put('/sites/{slug}', 'SiteController@update');
Route::get('/build/{theme?}', 'SiteController@create')->name('build');

Route::get('/images/{folder?}/{subfolder?}', 'ImageController@index');
Route::post('/images', 'ImageController@store');
Route::delete('/images', 'ImageController@destroy');


Route::get('/', function() {
	return view('landing.home');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
