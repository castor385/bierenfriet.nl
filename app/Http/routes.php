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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::group(['prefix' => 'api'], function () {
    Route::post('user/login', 'Auth\AuthController@authenticate');
    Route::post('user/logout', 'Auth\AuthController@logout');
    Route::resource('forum', 'ForumController', ['only' => ['index', 'create', 'update']]);

    Route::group(['middleware' => 'auth'], function () {
        Route::resource('user', 'UserController', ['only' => ['update']]);
    });
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
