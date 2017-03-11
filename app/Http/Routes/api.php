<?php 

Route::get('/users', 'ApiController@getUsers');
Route::post('/loginuser', 'UserController@login');
Route::post('/signupuser', 'UserController@signup');

Route::post('/addvendor/{user}', 'ApiController@addVendor');

Route::get('/livepromos', 'ApiController@getLivePromos');
Route::get('/liveads', 'ApiController@getLiveAds');
Route::get('/ads', 'ApiController@getStandardAds');


Route::get('/vendor/{vendor}/ads', 'ApiController@getVendorsAds');
Route::get('/vendor/{vendor}/promos', 'ApiController@getVendorsPromos');
Route::get('/vendor/{vendor}/liveads', 'ApiController@getVendorsLiveAds');
Route::get('/vendor/{vendor}/livepromos', 'ApiController@getVendorsLivePromos');

Route::post('/submitad/{vendor}', 'ApiController@submitAd');
Route::post('/submitpromo/{vendor}', 'ApiController@submitPromo');