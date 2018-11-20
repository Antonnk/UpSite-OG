<?php

Route::domain('{slug}.'.config('app.domain'))->group(function () {
    Route::get('/','SiteController@show')->middleware('cacheResponse')->name('site.show');
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
})->name('landing');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');