<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['loggedin'])->group(function () {
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::post('log-time', 'App\Http\Controllers\HomeController@logTime')->name('log-time');

    Route::prefix('incidents')->group(function ()
    {
        Route::get('/', 'App\Http\Controllers\IncidentsController@getIncidents')->name('incidents');
        Route::post('/', 'App\Http\Controllers\IncidentsController@postIncident')->name('incidents');

        Route::post('update/status', 'App\Http\Controllers\IncidentsController@updateStatus')->name('incidents/update/status');
        Route::post('update/description', 'App\Http\Controllers\IncidentsController@updateDescription')->name('incidents/update/description');
    });

    Route::get('incident-status', 'App\Http\Controllers\IncidentsController@getStatuses')->name('incident-statuses');
    Route::post('incident-status', 'App\Http\Controllers\IncidentsController@postStatus')->name('incident-statuses');

    Route::get('totals', 'App\Http\Controllers\TotalsController@getTotals')->name('totals');

    Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
});

Route::get('login', 'App\Http\Controllers\AuthController@getLogin')->name('login');
Route::get('register', 'App\Http\Controllers\AuthController@getRegister')->name('register');

Route::post('login', 'App\Http\Controllers\AuthController@postLogin')->name('registloginer');
Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::post('register', 'App\Http\Controllers\AuthController@postRegister')->name('register');
