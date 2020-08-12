<?php
Route::group(['namespace'=>'FrontEnd'],function(){
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index')->name('home');
    Route::get('/all/products/{department_id}','HomeController@allProducts')->name('all.products');
    Route::get('/product/{id}','HomeController@product')->name('product');

});
