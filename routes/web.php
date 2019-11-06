<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/create', 'URLController@store');
Route::get('/add', 'URLController@create');
Route::get('logout', 'Auth\\LoginController@logout');
