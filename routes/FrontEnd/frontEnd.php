<?php
Config::set('auth.defaults.guard','web');
Config::set('auth.defaults.passwords','users');

Route::group(['namespace'=>'FrontEnd'],function(){
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index')->name('home');
    Route::get('/all/products/{department_id}','HomeController@allProducts')->name('all.products');
    Route::get('/product/{id}','HomeController@product')->name('product');

    Route::get('/addCart/{productId}','CartController@addToCart')->name('cart.add');
    Route::get('/shopping-cart','CartController@showCart')->name('cart.show');
    Route::get('/checkout/{amount}','CartController@cartCheckout')->name('cart.checkout');
    Route::post('/charge','CartController@charge')->name('cart.charge');

    Route::get('/users/sign_in','UserController@signIn')->name('users.signIn');
    Route::post('/users/login','UserController@login')->name('user.login');
    Route::get('/users/sign_up','UserController@signUp')->name('users.signUp');
    Route::post('/users/create','UserController@store')->name('users.store');
    Route::get('/users/logout','UserController@logout')->name('user.logout');

});
