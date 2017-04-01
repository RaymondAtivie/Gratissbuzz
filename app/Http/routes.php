<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/login', 'AdminController@loginpage');
Route::post('/login', 'AdminController@login');
Route::get('/logout', 'AdminController@logout');

Route::group([
    'middleware' => ['admin']
], function () {
    Route::get('/', 'AdminController@dashboard');

    require_once("Routes/question.php");
    require_once("Routes/adverts.php");
    require_once("Routes/users.php");
    require_once("Routes/settings.php");
});


Route::group([
    'prefix' => 'api',
    'middleware' => 'cors'
], function () {
    require_once("Routes/api.php");
});
