<?php 

Route::get('users/viewall', 'UserController@viewAll');
Route::get('users/viewvendors', 'UserController@viewAllVendors');

Route::get('users/messageall', 'UserController@messageAll');
Route::post('users/sendmessagetoall', 'UserController@sendMessageToAll');
Route::post('users/sendmessagetoone', 'UserController@sendMessageToOne');

?>