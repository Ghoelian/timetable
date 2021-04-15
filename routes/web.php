<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('data-entry', 'App\Http\Controllers\DataEntryController@index')->name('data-entry');
Route::get('overviews', 'App\Http\Controllers\OverviewsController@index')->name('overviews');

Route::get('login', 'App\Http\Controllers\AuthController@getLogin')->name('login');
Route::get('register', 'App\Http\Controllers\AuthController@getRegister')->name('register');

Route::post('login', 'App\Http\Controllers\AuthController@postLogin')->name('registloginer');
Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::post('register', 'App\Http\Controllers\AuthController@postRegister')->name('register');