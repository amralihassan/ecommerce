<?php


Route::group(['namespace'=>'FrontEnd'],function(){
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index')->name('home');
    Route::get('/all/products/{department_id}','HomeController@allProducts')->name('all.products');
    Route::get('/product/{id}','HomeController@product')->name('product');

    Route::get('/addCart/{productId}','CartController@addToCart')->name('cart.add');
    Route::get('/shopping-cart','CartController@showCart')->name('cart.show');
    Route::post('/charge','CartController@charge')->name('cart.charge');
    Route::delete('/cart/remove/{product_id}','CartController@remove')->name('cart.remove');

    /**
     * all users
     */
    require 'userRoutes.php';
});
