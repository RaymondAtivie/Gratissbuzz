<?php

Route::get('question/add', 'QuestionController@add');
Route::get('question/allocate', 'QuestionController@allocate');
Route::get('question/list', 'QuestionController@lists');

Route::get('batch/create', 'QuestionController@createBatch');
Route::get('batch/assign', 'QuestionController@assignBatch');

Route::post('question/create', 'QuestionController@createQuestion');