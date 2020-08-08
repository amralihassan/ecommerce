<?php
Route::group(['namespace'=>'BackEnd\Settings'],function(){
    /**
     * County
     */
    Route::resource('/settings/countries','CountryController')->except('show','destroy');
    Route::post('countries/destroy','CountryController@destroy')->name('countries.destroy');
    Route::get('get/countries','CountryController@getCountries')->name('get.countries');
    Route::put('country/selected','CountryController@getCountrySelected')->name('country.selected');

    /**
     * City
     */
    Route::resource('/settings/cities','CityController')->except('show','destroy');
    Route::post('cities/destroy','CityController@destroy')->name('cities.destroy');
    Route::get('get/cities','CityController@getCities')->name('get.cities');
    Route::put('city/selected','CityController@getCitySelected')->name('city.selected');

    /**
     * State
     */
    Route::resource('/settings/states','StateController')->except('show','destroy');
    Route::post('states/destroy','StateController@destroy')->name('states.destroy');

    /**
     * Category
     */
    Route::resource('/settings/categories','CategoryController')->except('show','destroy');
    Route::post('categories/destroy','CategoryController@destroy')->name('categories.destroy');
    Route::get('get/categories','CategoryController@getCategories')->name('get.categories');
    Route::put('category/selected','CategoryController@getCategorySelected')->name('category.selected');
});
