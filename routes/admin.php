<?php
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
    Config::set('auth.defaults.guard','admin');
    Config::set('auth.defaults.passwords','users');
    // ========================================= CONFIGURATIONS ======================================

    // ========================================= END CONFIGURATIONS ==================================
    // ========================================= LOGIN ===============================================
        Route::get('/login','AdminAuth@login');
        Route::post('/signIn','AdminAuth@setLogin')->name('setLogin');

        Route::get('/',function(){

            if (session()->has('login')) {
                if (adminAuth()->check()) {
                    Route::get('/dashboard','DashboardController@index');
                }
                else{
                    Route::get('/login','AdminAuth@login');
                }
            }
            else{
                Route::get('/login','AdminAuth@login');
            }
        });
	    // ========================================= LANG ================================================
            Route::get('lang/{lang}',function($lang){
                // check session lang and destroy session
                $data['lang'] = $lang;

                if (adminAuth()->check()) {
                    \App\Models\Admin::where('id',authInfo()->id)->update($data);
                }

                session()->has('lang')?session()->forget('lang'):'';
                // set new session
                $lang == 'ar' || $lang == trans('admin.ar') ? session()->put('lang','ar'):session()->put('lang','en');
                //return to previous page
                return back();
            });
        // ========================================= END LANG ============================================

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

            // update settings
            Route::get('/settings','SettingController@siteSettingPage')->name('site.settings');
            Route::post('update/settings','SettingController@updateSettings')->name('update.settings');

            // admin
            Route::get('/users','UserController@index')->name('users.index');
            Route::post('users/destroy','UserController@destroy')->name('users.destroy');

            // settings
            require 'BackEnd/settings.php';

            // BackEnd
            require 'BackEnd/backEnd.php';

        });
});
// FrontEnd
require 'FrontEnd/frontEnd.php';
