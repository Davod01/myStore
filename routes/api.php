<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/shop', 'homeController@shop');

Route::get('/shop/{product}', 'homeController@getProduct');

Route::post('/auth/login', 'userController@login');

Route::post('/auth/register', 'userController@register');

Route::get('/auth/refresh', 'userController@refresh');


Route::middleware('auth:api')->group(function () {
    // Get user info
    Route::get('/auth/user', 'userController@user');
    // Logout user from application
    Route::post('/auth/logout', 'userController@logout');


});