<?php 

Route::get('/', function(){
    phpinfo();
});

Route::get('/users', 'ApiController@getUsers');
Route::post('/loginuser', 'UserController@login');
Route::post('/signupuser', 'UserController@signup');

Route::post('/updatepicture/{user_id}', 'UserController@updatePicture');
Route::post('/updatevendorpicture/{vendor_id}', 'UserController@updateVendorPicture');

Route::post('/addvendor/{user}', 'ApiController@addVendor');

Route::post('/livepromos', 'ApiController@getLivePromosSearch');
Route::post('/liveads', 'ApiController@getLiveAdsSearch');

Route::get('/livepromos', 'ApiController@getLivePromos');
Route::get('/liveads', 'ApiController@getLiveAds');
Route::get('/ads', 'ApiController@getStandardAds');

Route::get('/messages/{user}', 'ApiController@getUserMessages');
Route::get('/messages/{user}/num', 'ApiController@getUserMessagesNum');
Route::get('/messages/{message}/seen', 'ApiController@readMessage');

Route::get('/vendors', 'ApiController@allVendors');
Route::get('/vendors/{vendor}/finder', 'ApiController@addToBrandFinder');
Route::get('/vendor/{vendor}/ads', 'ApiController@getVendorsAds');
Route::get('/vendor/{vendor}/promos', 'ApiController@getVendorsPromos');
Route::get('/vendor/{vendor}/liveads', 'ApiController@getVendorsLiveAds');
Route::get('/vendor/{vendor}/livepromos', 'ApiController@getVendorsLivePromos');

Route::post('/submitad/{vendor}', 'ApiController@submitAd');
Route::post('/submitpromo/{vendor}', 'ApiController@submitPromo');

Route::get('/promo/{promo}/interactive', 'ApiController@makePromoInteractive');

Route::post('/submitpromocomment/{promo}', 'ApiController@submitPromoComment');
Route::post('/submitadcomment/{ad}', 'ApiController@submitAdComment');

Route::post('/submitpromoshare/{promo}', 'ApiController@submitPromoShare');
Route::post('/submitadshare/{ad}', 'ApiController@submitAdShare');

Route::post('/submitpromolike/{promo}', 'ApiController@submitPromoLike');
Route::post('/submitadlike/{ad}', 'ApiController@submitAdLike');
Route::post('/checkadlike/{ad}', 'ApiController@checkAdLike');
Route::post('/checkpromolike/{promo}', 'ApiController@checkPromoLike');

Route::get('/getBusinessCategories', 'ApiController@getBusinessCategories');
Route::get('/getStates', 'ApiController@getStates');

Route::post('/answerquestion/{livead}', 'ApiController@answerQuestion');
Route::post('/isanswered/{livead}', 'ApiController@isQuestionAnswered');

Route::get('/processwinners', 'WinnerController@processWinners');
Route::get('/winners', 'WinnerController@getWinners');

Route::get('/content/{content_name}', 'ApiController@getContent');

Route::post('/contact_us/{user_id}', 'ApiController@contactUs');