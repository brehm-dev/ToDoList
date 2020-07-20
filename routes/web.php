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
    return view('home', [
        'testkey' => 'testval'
    ]);
//        return redirect("login");
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



Route::prefix('user')->group(function () {
    Route::post('/', 'UserController@create')->name('user.create');
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('{id}', 'UserController@show')->name('user.read');
    Route::patch('{id}', 'UserController@update')->name('user.update');
    Route::delete('{id}', 'UserController@destroy')->name('user.delete');
});
