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

Route::get('/', function () {
    return view('dashboard');
//    return redirect("login");
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/users', 'UserController@index')->name('index.user');
Route::get('/schedules', 'ScheduleController@index')->name('index.schedules');
Route::get('/todos', 'ToDoController@index')->name('index.todos');


Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@createForm')->name('form.user');
    Route::post('/', 'UserController@create')->name('create.user');
    Route::get('{user}', 'UserController@view')->name('read.user');
    Route::patch('{user}', 'UserController@update')->name('update.user');
    Route::delete('{user}', 'UserController@destroy')->name('delete.user');
});

Route::prefix('schedule')->group(function () {
    Route::get('/', 'ScheduleController@create')->name('form.schedule');
    Route::post('/', 'ScheduleController@store')->name('create.schedule');
    Route::get('{schedule}', 'ScheduleController@view')->name('read.schedule');
    Route::patch('{schedule}', 'ScheduleController@update')->name('update.schedule');
    Route::delete('{schedule}', 'ScheduleController@destroy')->name('delete.schedule');
    Route::prefix('/{schedule}/todo')->group(function () {
        Route::get('/', 'ToDoController@create')->name('form.todo');
        Route::post('/', 'ToDoController@store')->name('create.todo');
        Route::get('/{todo}', 'ToDoController@show')->name('read.todo');
        Route::patch('/{todo}', 'ToDoController@update')->name('update.todo');
        Route::delete('/{todo}', 'ToDoController@destroy')->name('delete.todo');
    });
});
