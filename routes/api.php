<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',    'AuthController@login');
    Route::post('logout',   'AuthController@logout');
    Route::post('refresh',  'AuthController@refresh');
    Route::post('me',       'AuthController@me');

});

    
Route::get('/crud/schemas', 'Crud@schemas');
Route::post('/crud/tables', 'Crud@tables');
Route::post('/crud/generate', 'Crud@generate');

require base_path("routes/api/controlPerceptivo.php");
require base_path("routes/api/dicom.php");
require base_path("routes/api/facturero.php");
require base_path("routes/api/fas.php");
require base_path("routes/api/general.php");

//dinamicRoutes

//newRoutes
