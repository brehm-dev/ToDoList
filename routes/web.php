<?php

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

Auth::routes();

Route::get('/', function () {
    return view('dashboard');
//    return redirect("login");
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/users', 'UserController@index')->name('users.index');
//Route::prefix('users')->group(function () {
//    Route::get
//});

Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@createForm')->name('user.create');
    Route::post('/', 'UserController@create')->name('user.create.post');
    Route::get('{id}', 'UserController@view')->name('user.view');
    Route::patch('{id}', 'UserController@update')->name('user.update');
    Route::delete('{id}', 'UserController@destroy')->name('user.delete');
});
