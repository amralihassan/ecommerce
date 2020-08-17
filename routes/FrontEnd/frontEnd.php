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
    Route::post('/charge','CartController@charge')->name('cart.charge');

    /**
     * all users
     */
    require 'userRoutes.php';
});
