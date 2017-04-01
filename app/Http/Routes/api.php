<?php 

Route::get('/users', 'ApiController@getUsers');
Route::post('/loginuser', 'UserController@login');
Route::post('/signupuser', 'UserController@signup');

Route::post('/addvendor/{user}', 'ApiController@addVendor');

Route::get('/livepromos', 'ApiController@getLivePromos');
Route::get('/liveads', 'ApiController@getLiveAds');
Route::get('/ads', 'ApiController@getStandardAds');

Route::get('/messages/{user}', 'ApiController@getUserMessages');
Route::get('/messages/{user}/num', 'ApiController@getUserMessagesNum');
Route::get('/messages/{message}/seen', 'ApiController@readMessage');

Route::get('/vendor/{vendor}/ads', 'ApiController@getVendorsAds');
Route::get('/vendor/{vendor}/promos', 'ApiController@getVendorsPromos');
Route::get('/vendor/{vendor}/liveads', 'ApiController@getVendorsLiveAds');
Route::get('/vendor/{vendor}/livepromos', 'ApiController@getVendorsLivePromos');

Route::post('/submitad/{vendor}', 'ApiController@submitAd');
Route::post('/submitpromo/{vendor}', 'ApiController@submitPromo');

Route::post('/submitpromocomment/{promo}', 'ApiController@submitPromoComment');

Route::get('/getBusinessCategories', 'ApiController@getBusinessCategories');
Route::get('/getStates', 'ApiController@getStates');