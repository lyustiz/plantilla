<?php

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
 ]);

Route::post('/crud', 'crud@generate')->name('generate');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('{path}', function () {
    return view('home');
})->where('path', '(.*)');
