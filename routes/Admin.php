<?php

Route::post('/admin/login', 'AuthController@login')->name('admin.login');

    Route::group(['middleware' => 'auth:Admin'], function () {

        Route::get('/logout/logout', 'AuthController@logout')->name('user.logout');
        Route::get('/home', 'AuthController@index')->name('admin.dashboard');

        /** Auth Routes */
        Route::prefix('Auth')->group(function () {
            Route::get('/logout', 'AuthController@logout')->name('user.logout');
            Route::get('/home', 'AuthController@index')->name('admin.dashboard');
        });

        /** User Routes */
        Route::prefix('User')->group(function () {
            Route::get('/index', 'UserController@index')->name('User.index');
            Route::get('/allData', 'UserController@allData')->name('User.allData');
            Route::get('/single', 'UserController@single')->name('User.single');
            Route::post('/create', 'UserController@create')->name('User.create');
            Route::post('/update', 'UserController@update')->name('User.update');
            Route::get('/delete', 'UserController@delete')->name('User.delete');
        });

        /** Post Routes */
        Route::prefix('Post')->group(function () {
            Route::get('/index', 'PostController@index')->name('Post.index');
            Route::get('/allData', 'PostController@allData')->name('Post.allData');
            Route::get('/single', 'PostController@single')->name('Post.single');
            Route::post('/create', 'PostController@create')->name('Post.create');
            Route::post('/update', 'PostController@update')->name('Post.update');
            Route::get('/delete', 'PostController@delete')->name('Post.delete');
        });
    });
/** Auth Routes */
Route::prefix('Auth')->group(function () {
    Route::post('/checkLogin', 'AuthController@login')->name('admin.login');
    Route::get('/login', 'AuthController@loginForm')->name('admin.loginForm');
});

