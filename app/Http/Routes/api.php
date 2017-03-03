<?php 

Route::get('/users', 'ApiController@getUsers');

Route::get('/livepromos', 'ApiController@getLivePromos');

Route::get('/liveads', 'ApiController@getLiveAds');

Route::get('/ads', 'ApiController@getStandardAds');
