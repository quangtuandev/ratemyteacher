<?php
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/redirect/{provider}', 'SocialController@redirectToProvider');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/active/{token}', 'UserController@active');

    Route::get('/user', 'UserController@index');
});
Route::get('/images/{path}', function (Illuminate\Http\Request $request, $path) {
    return app('glide')->getImageResponse($path, $request->all());
})->where('path', '.*');
// Admin

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('login', function () {
        if (Auth::check()) return redirect('admin');
        return view('admin.login');
    })->name('admin.login.get');

    Route::post('login', 'AuthController@login')->name('admin.login');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('user.list');
            Route::get('{id?}/delete', 'UserController@destroy')->name('user.delete');
        });
        Route::group(['prefix' => 'teachers'], function () {
            Route::get('/', 'TeacherController@index')->name('teacher.list');
            Route::get('{id?}/delete', 'TeacherController@destroy')->name('teacher.delete');
        });
        Route::group(['prefix' => 'reviews'], function () {
            Route::get('/', 'ReviewController@index')->name('review.list');
            Route::get('{id?}/delete', 'ReviewController@destroy')->name('review.delete');
        });
        Route::group(['prefix' => 'centers'], function () {
            Route::get('/', 'CenterController@index')->name('center.list');
            Route::get('{id?}/delete', 'CenterController@destroy')->name('center.delete');
        });
    });
});
Route::get('/{vue_capture?}', function () {
    return view('app');
})->where('vue_capture', '(.*)')->name('app_main');

