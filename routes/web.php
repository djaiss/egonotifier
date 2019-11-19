<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', 'Auth\\RegisterController@show')->name('register');
Route::post('register', 'Auth\\RegisterController@store');

//Auth::routes(['verify' => true]);
Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/create', 'URLController@store');
    Route::get('/add', 'URLController@create');
    Route::get('/account', 'AccountController@show');
    Route::get('/delete', 'AccountController@destroy');
    Route::get('logout', 'Auth\\LoginController@logout');
});
