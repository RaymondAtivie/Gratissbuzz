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


?>