<?php

Route::get('question/add', 'QuestionController@add');
Route::get('question/allocate', 'QuestionController@allocate');
Route::get('question/list', 'QuestionController@lists');
Route::get('question/{question}/delete', 'QuestionController@deleteQuestion');
Route::post('question/{question}/edit', 'QuestionController@editQuestion');

Route::get('batch/create', 'QuestionController@createBatch');
Route::get('batch/assign', 'QuestionController@assignBatch');

Route::post('question/create', 'QuestionController@createQuestion');