<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->group(function () {

    /** Auth Routes */
    Route::prefix('Auth')->group(function () {
        Route::get('/my_info', 'UserController@my_info');
    });

    /** Post Routes */
    Route::prefix('Post')->group(function () {
        Route::get('/posts', 'PostController@posts');
        Route::post('/save_post', 'PostController@save_post');
    });
});

/** Auth */
Route::prefix('Auth')->group(function () {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
});
