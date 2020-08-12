<?php
    Route::group(['namespace'=>'BackEnd'],function(){
        // Offer
        Route::resource('/offers','OfferController')->except('show');
        // Seller
        Route::resource('/sellers','SellerController')->except('show','destroy');
        Route::post('sellers/destroy','SellerController@destroy')->name('sellers.destroy');
        Route::get('get/sellers','SellerController@getSellers')->name('get.sellers');
        Route::put('seller/selected','SellerController@getSellerSelected')->name('seller.selected');

        // Product
        Route::resource('/products','ProductController')->except('destroy');
        Route::post('products/destroy','ProductController@destroy')->name('products.destroy');

        // Product Specifications
        Route::resource('/productSpecifications','ProductSpecificationsController')->except('index','create','destroy','show');
        Route::get('productSpecifications/index/{id}','ProductSpecificationsController@index')->name('productSpecifications.index');
        Route::get('productSpecifications/create/{id}','ProductSpecificationsController@create')->name('productSpecifications.create');
        Route::post('productSpecifications/destroy','ProductSpecificationsController@destroy')->name('productSpecifications.destroy');

    });
