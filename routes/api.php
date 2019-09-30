<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:api')->get('/user', 'Api\UserController@authUser');
Route::group(['namespace' => 'Api','middleware' => ['xssProtection']], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'ResetPasswordController@reset');
        Route::middleware('auth:api')->post('logout','AuthController@logout')->name('logout');
    });

    Route::post('check-exist', 'CommonController@checkExist');

    Route::group(['prefix' => 'teacher'], function () {
        Route::get('/all/center', 'TeacherController@list');
        Route::get('/show/{id}', 'TeacherController@show');
        Route::get('/{id}/review', 'TeacherController@getReviewTeacher');
        Route::get('/{id}/over-view','TeacherController@getOverView');
        Route::middleware('auth:api')->post('/new', 'TeacherController@store');
    });

    Route::group(['prefix' => 'review'], function () {
        Route::get('/show/{id}', 'ReviewTeacherController@show');
        Route::patch('/edit', 'ReviewTeacherController@edit');
        Route::get('/lastest', 'ReviewTeacherController@getLastest');
        Route::group(['middleware' => 'auth:api'],function (){
            Route::post('/new', 'ReviewTeacherController@createReviewTeacher');
            Route::delete('/delete/{id}', 'ReviewTeacherController@deleteReviewTeacher');
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/show/{id}', 'UserController@show');
        Route::get('/show/{userId}/review', 'UserController@getReview');
    });

    Route::group(['prefix' => 'centers'], function () {
        Route::get('/', 'CenterController@index');
        Route::get('/{id}', 'CenterController@show');
    });

    Route::group(['prefix' => 'file', 'as' => 'file'], function () {
        Route::post('upload', 'UploadController@upload')->name('upload');
        Route::delete('delete/{path?}', 'UploadController@delete')->name('delete')->where('path', '.+');
    });

    Route::get('search', 'SearchController@search')->name('search');
});


