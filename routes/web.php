<?php


Route::post('/crud', 'crud@generate')->name('generate');


Route::get('/', function () {
    return view('home');
});

Route::get('{path}', function () {
    return view('home');
})->where('path', '(.*)');
