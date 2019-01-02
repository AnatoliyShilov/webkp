<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@index');
Route::get('/products/type/{id}', 'ProductController@index');


Route::group(['middleware' => 'checkUser'],
    function ()
    {
        Route::get('/basket', 'BasketController@index'); // user
        Route::get('/basket', 'BasketController@index'); // user
        Route::post('/tobasket/{id}', 'BasketController@toBasket'); // user
        Route::delete('/basket/{id}', 'BasketController@destroy'); // user

        Route::get('/userorders/create', 'UserOrderController@create'); // user
        Route::post('/userorders', 'UserOrderController@store'); // user

        Route::post('/comments', 'CommentController@store'); // user

        Route::post('/products/{id}/rating', 'ProductController@rating'); // user

        Route::group(['middleware' => 'checkAdmin'],
            function ()
            {
                Route::get('/products/create', 'ProductController@create'); // admin
                Route::post('/products', 'ProductController@store'); // admin
                Route::get('/products/{id}/edit', 'ProductController@edit'); // admin
                Route::put('/products/{id}', 'ProductController@update'); // admin
                Route::delete('/products/{id}', 'ProductController@destroy'); // admin

                Route::get('/types', 'TypeController@index'); // admin
                Route::get('/types/create', 'TypeController@create'); // admin
                Route::post('/types', 'TypeController@store'); // admin
                Route::get('/types/{id}', 'TypeController@show'); // admin
                Route::get('/types/{id}/edit', 'TypeController@edit'); // admin
                Route::put('/types/{id}', 'TypeController@update'); // admin
                Route::delete('/types/{id}', 'TypeController@destroy'); // admin

                Route::get('/statuses', 'StatusController@index'); // admin
                Route::get('/statuses/create', 'StatusController@create'); // admin
                Route::post('/statuses', 'StatusController@store'); // admin
                Route::get('/statuses/{id}', 'StatusController@show'); // admin
                Route::get('/statuses/{id}/edit', 'StatusController@edit'); // admin
                Route::put('/statuses/{id}', 'StatusController@update'); // admin
                Route::delete('/statuses/{id}', 'StatusController@destroy'); // admin

                Route::get('/paytypes', 'PayTypeController@index'); // admin
                Route::get('/paytypes/create', 'PayTypeController@create'); // admin
                Route::post('/paytypes', 'PayTypeController@store'); // admin
                Route::get('/paytypes/{id}', 'PayTypeController@show'); // admin
                Route::get('/paytypes/{id}/edit', 'PayTypeController@edit'); // admin
                Route::put('/paytypes/{id}', 'PayTypeController@update'); // admin
                Route::delete('/paytypes/{id}', 'PayTypeController@destroy'); // admin

                Route::get('/deliverytypes', 'DeliveryTypeController@index'); // admin
                Route::get('/deliverytypes/create', 'DeliveryTypeController@create'); // admin
                Route::post('/deliverytypes', 'DeliveryTypeController@store'); // admin
                Route::get('/deliverytypes/{id}', 'DeliveryTypeController@show'); // admin
                Route::get('/deliverytypes/{id}/edit', 'DeliveryTypeController@edit'); // admin
                Route::put('/deliverytypes/{id}', 'DeliveryTypeController@update'); // admin
                Route::delete('/deliverytypes/{id}', 'DeliveryTypeController@destroy'); // admin

                Route::get('/users', 'UserController@index'); // admin
                Route::get('/users/create', 'UserController@create'); // admin
                Route::post('/users', 'UserController@store'); // admin

                Route::get('/users/{id}/edit', 'UserController@edit'); // admin
                Route::put('/users/{id}', 'UserController@update'); // admin
                Route::delete('/users/{id}', 'UserController@destroy'); // admin

                Route::get('/userorders', 'UserOrderController@index'); // admin
                Route::get('/userorders/{id}/edit', 'UserOrderController@edit'); //admin
                Route::put('/userorders/{id}', 'UserOrderController@update'); // admin
            }
        );

        Route::get('/users/{id}', 'UserController@show')->middleware('checkUserId'); // user id

        Route::get('/userorders/{id}', 'UserOrderController@show')->middleware('checkUserId:userOrder'); // user id
    }
);

Route::get('/products/{id}', 'ProductController@show');

Auth::routes();