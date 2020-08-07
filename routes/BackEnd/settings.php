<?php
Route::group(['namespace'=>'BackEnd\Settings'],function(){
    /**
     * County
     */
    Route::resource('/settings/countries','CountryController')->except('show','destroy');
    Route::post('countries/destroy','CountryController@destroy')->name('countries.destroy');
});
