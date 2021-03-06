<?php
// Config::set('auth.defaults.guard','web');
Route::group(['namespace'=>'FrontEnd'],function(){
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index')->name('home');
    Route::get('/all/products/{department_id}','HomeController@allProducts')->name('all.products');
    Route::get('/product/{id}','HomeController@product')->name('product');

    Route::get('/addCart/{productId}','CartController@addToCart')->name('cart.add');
    Route::get('/shopping-cart','CartController@showCart')->name('cart.show');
    Route::post('/charge','CartController@charge')->name('cart.charge');
    Route::delete('/cart/remove/{product_id}','CartController@remove')->name('cart.remove');
    Route::put('/cart/update/{product_id}','CartController@updateQuantity')->name('cart.update');

    // filter all products
    Route::get('/all/products/filter/{department_id}','HomeController@filter')->name('products.filter');

    // autocomplete search
    Route::post('/autocomplete/fetch', 'HomeController@fetch')->name('autocomplete.fetch');
    Route::get('/product/search/{department_id}', 'HomeController@productSearch')->name('product.search');


    /**
     * all users
     */
    require 'userRoutes.php';
});
