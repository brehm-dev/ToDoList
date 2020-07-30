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
    return redirect("dashboard");
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// listing routes
Route::get('/users', 'UserController@index')->name('user.index');
Route::get('/schedules', 'ScheduleController@index')->name('schedule.index');
Route::get('/schedule/{schedule}/procedures', 'ProcedureController@index')->name('procedures.index');


Route::prefix('user')->group(function () {
    Route::post('/', 'UserController@store')->name('user.create');
    Route::get('/{user}', 'UserController@view')->name('user.view');
    Route::patch('/{user}', 'UserController@update')->name('user.update');
    Route::delete('/{user}', 'UserController@destroy')->name('user.delete');
});

Route::prefix('schedule')->group(function () {
    Route::post('/', 'ScheduleController@store')->name('schedule.create');
    Route::get('/{schedule}', 'ScheduleController@show')->name('schedule.view');
    Route::patch('/{schedule}', 'ScheduleController@update')->name('schedule.update');
    Route::delete('/{schedule}', 'ScheduleController@destroy')->name('schedule.delete');

    // procedure routes
    Route::post('/{schedule}/procedure/', 'ProcedureController@store')->name('procedure.create');
    Route::get('/{schedule}/procedure/{procedure}', 'ProcedureController@show')->name('procedure.view');
    Route::patch('/{schedule}/procedure/{procedure}', 'ProcedureController@update')->name('procedure.update');
    Route::delete('/{schedule}/procedure/{procedure}', 'ProcedureController@destroy')->name('procedure.delete');
});
