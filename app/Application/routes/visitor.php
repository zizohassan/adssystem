<?php
Auth::routes();

Route::get('/user/ads' , 'HomeController@getUserAds');
Route::get('addAds' , 'HomeController@addAds');
Route::post('addNewAds' , 'HomeController@addNewAds');

Route::get('search' , 'HomeController@search');
Route::get('getState/{id}' , 'HomeController@getState');



Route::get('/{slug?}/{state?}/{cat?}', 'HomeController@welcome');
Route::get('/product/{country}/{state}/{cat}/{slug}', 'HomeController@getProductBySlug');
Route::get('/page/{slug}', 'HomeController@getPageBySlug');


