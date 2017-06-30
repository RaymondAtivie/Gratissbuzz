<?php

Route::get('question/addCategory', 'QuestionController@addCategory');
Route::post('question/addCategory', 'QuestionController@addNewCategory');
Route::get('/settings/questions', 'QuestionController@addCategory');

Route::get('/settings/business', 'SettingsController@business');
Route::post('/settings/addBusiness', 'SettingsController@addBusiness');

Route::get('/settings/states', 'SettingsController@states');
Route::post('/settings/addLga', 'SettingsController@addLga');
Route::post('/settings/addState', 'SettingsController@addState');

Route::get('/settings/removeState/{statename}', 'SettingsController@removeState');
Route::get('/settings/removeLGA/{lganame}', 'SettingsController@removeLGA');

////////// CONTENT ROUTES //////////
Route::get('/content/faq/', 'ContentController@faq');
Route::post('/content/faq/', 'ContentController@addfaq');

Route::get('/content/how/', 'ContentController@how');
Route::post('/content/how/', 'ContentController@addhow');

Route::get('/content/about/', 'ContentController@about');
Route::post('/content/about/', 'ContentController@addabout');

Route::get('/content/contact/', 'ContentController@contact');
Route::post('/content/contact/', 'ContentController@addcontact');

Route::get('/content/terms/', 'ContentController@terms');
Route::post('/content/terms/', 'ContentController@addterms');

Route::get('/content/privacy/', 'ContentController@privacy');
Route::post('/content/privacy/', 'ContentController@addprivacy');

?>