<?php

Route::get('advert/pendingAds', 'AdvertController@pendingAds');
Route::get('advert/approvedAds', 'AdvertController@showApprovedAds');
Route::get('advert/approve/{ad}', 'AdvertController@approveAd');
Route::get('advert/unapprove/{ad}', 'AdvertController@unapproveAd');

Route::get('advert/pendingPromos', 'AdvertController@pendingPromos');
Route::get('advert/approvedPromos', 'AdvertController@showApprovedPromos');
Route::get('advert/approvepromo/{promo}', 'AdvertController@approvePromo');
Route::get('advert/unapprovepromo/{promo}', 'AdvertController@unapprovePromo');

Route::any('advert/promogolive/{promo}', 'AdvertController@promoGoLive');
Route::any('advert/adgolive/{ad}', 'AdvertController@adGoLive');

Route::any('advert/livepromos', 'AdvertController@showLivePromos');
Route::any('advert/liveads', 'AdvertController@showLiveAds');

Route::get('advert/standardads', 'AdvertController@standardAds');
Route::post('advert/newstandardad', 'AdvertController@addStandardAds');