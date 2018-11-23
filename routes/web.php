<?php

Route::domain('{slug}.'.config('app.domain'))->group(function () {
    Route::get('/','SiteController@show')->middleware('cacheResponse')->name('site.show');
    Route::get('/manifest.json','SiteController@manifest')->middleware('cacheResponse')->name('site.manifest');
});

Route::post('/sites', 'SiteController@store');
Route::delete('/sites/{slug}', 'SiteController@destroy');
Route::put('/sites/{slug}/claim', 'SiteController@claim');
Route::put('/sites/{slug}', 'SiteController@update');


Route::get('/skabeloner', 'ThemeController@index')->name('build.overview');
Route::get('/build/{theme?}', 'SiteController@create')->name('build');

Route::get('/images/{folder?}/{subfolder?}', 'ImageController@index');
Route::post('/images', 'ImageController@store');
Route::delete('/images', 'ImageController@destroy');


Route::get('/', 'LandingController@index')->name('landing');
Route::get('/priser', 'LandingController@pricing')->name('pricing');
Route::get('/kontakt', 'LandingController@contact')->name('contact');

Auth::routes();
Route::get('/konto', 'AccountController@index')->name('account.index');
Route::get('/konto/rediger', 'AccountController@edit')->name('account.edit');
Route::post('/konto/rediger', 'AccountController@update')->name('account.update');