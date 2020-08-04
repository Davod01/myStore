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




Route::get('/auth/refresh', 'userController@refresh');


Route::group([

    'middleware' => 'visit',

    ],
    function () {
        Route::get('/shop', 'homeController@shop');

        Route::get('/shop/{product}', 'homeController@getProduct');

        Route::post('/auth/login', 'userController@login');

        Route::post('/auth/register', 'userController@register');
    });

// Users route Group

Route::group([

    'middleware' => ['api','visit'],

    ],
    function () {
        Route::post('/user/ordered', 'OrderController@store');

        // Logout user from application
        Route::post('/auth/logout', 'userController@logout');
    });


// Admin route Group

Route::group([

    'middleware' => 'api',

    ],
    function () {

    // admin rutes
    Route::get('/admin/getStatics', 'adminController@getStatics');

    // Get user info
    Route::get('/auth/user', 'userController@user');

    Route::get('/admin/getOrderDataChart', 'adminController@getOrderDataChart');

    Route::get('/admin/getOrdersPagination', 'adminController@getOrders');

    Route::get('/admin/getUsersPagination', 'adminController@getUsers');

    Route::get('/admin/getProductsPagination', 'adminController@getProducts');

    Route::post('/admin/deleteProduct', 'adminController@destroyProduct');

    Route::post('/admin/product/add', 'adminController@addProduct');

    Route::post('/admin/product/update', 'adminController@updateProduct');


});