<?php
    Route::get('/users/sign_in','UserController@signIn')->name('users.signIn');
    Route::post('/users/login','UserController@login')->name('user.login');
    Route::get('/users/sign_up','UserController@signUp')->name('users.signUp');
    Route::post('/users/create','UserController@store')->name('users.store');
    Route::get('/users/logout','UserController@logout')->name('user.logout');

    Route::group(['middleware'=>'user'],function(){
        Route::get('/checkout/{amount}','CartController@cartCheckout')->name('cart.checkout');
        Route::get('/user/orders','OrderController@index')->name('user.orders');

    });
