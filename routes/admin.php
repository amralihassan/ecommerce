<?php
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
    // ========================================= CONFIGURATIONS ======================================
        Config::set('auth.defaults.guard','admin');
        Config::set('auth.defaults.passwords','users');
    // ========================================= END CONFIGURATIONS ==================================
    // ========================================= LOGIN ===============================================
        Route::get('/login','AdminAuth@login');
        Route::post('/signIn','AdminAuth@setLogin')->name('setLogin');

        Route::get('/',function(){

            if (session()->has('login')) {
                if (adminAuth()->check()) {
                    Route::get('/dashboard','DashboardController@index')->name('main.dashboard');
                }
                else{
                    Route::get('/login','AdminAuth@login');
                }
            }
            else{
                Route::get('/login','AdminAuth@login');
            }
        });

    // ================================= LOGOUT ==============================================

    Route::group(['middleware'=>'admin'],function(){
            Route::any('/logout','AdminAuth@logout')->name('logout');
            Route::get('/','DashboardController@index');

            // dashboards
            Route::get('/dashboard','DashboardController@index')->name('main.dashboard');
            // change password
            Route::get('/password','AdminAuth@changePassword');
            Route::post('/update/password','AdminAuth@updateChangePassword')->name('update.password');

            // admin
            Route::resource('/accounts','AdminController')->except('show','destroy');
            Route::post('accounts/destroy','AdminController@destroy')->name('accounts.destroy');
            // user profile
            Route::get('user-profile','AdminController@userProfile')->name('user-profile');
            Route::post('user-profile','AdminController@updateProfile')->name('update.profile');


        });

});
Route::group(['namespace'=>'frontEnd'],function(){
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index')->name('home');
    Route::get('/product','HomeController@product')->name('product');
    Route::get('/all/products','HomeController@allProducts')->name('all.product');

});
