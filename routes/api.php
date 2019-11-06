<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('banco', 'HomeController@banco');
Route::get('ofertaComercial', 'HomeController@ofertaComercial');

Route::group(['prefix'=>'v1'], function() {
    
    Route::get('/crud/schemas', 'Crud@schemas');

    Route::post('/crud/tables', 'Crud@tables');

    Route::post('/crud/generate', 'Crud@generate');

//dinamicRoutes

Route::apiResource('/status',     'StatusController');
Route::apiResource('/motivo',     'MotivoController');
Route::apiResource('/bitacora',     'BitacoraController');
Route::apiResource('/empresa',     'EmpresaController');
Route::apiResource('/tipoVisitante',     'TipoVisitanteController');
Route::apiResource('/visitante',     'VisitanteController');
Route::apiResource('/visita',     'VisitaController');
Route::apiResource('/tipoAlerta',     'TipoAlertaController');
Route::apiResource('/usuario',     'UsuarioController');
Route::apiResource('/visitanteAlerta',     'VisitanteAlertaController');
//newRoutes
});