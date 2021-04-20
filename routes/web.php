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
    Route::post('totals/send', 'App\Http\Controllers\TotalsController@sendTotals')->name('totals/send');
    // Route::get('charts', 'App\Http\Controllers\ChartsController@getCharts')->name('charts');

    Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

    Route::prefix('user')->group(function () {
        Route::get('contacts', 'App\Http\Controllers\UsersController@getContacts')->name('user/contacts');

        Route::post('contacts/add', 'App\Http\Controllers\UsersController@addContact')->name('user/contacts/add');
        Route::post('contacts/toggle', 'App\Http\Controllers\UsersController@toggleContact')->name('user/contacts/toggle');
    });
});

Route::get('login', 'App\Http\Controllers\AuthController@getLogin')->name('login');
Route::post('login', 'App\Http\Controllers\AuthController@postLogin')->name('login');
