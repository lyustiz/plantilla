<?php

Route::middleware('jwt.auth')->group(function () {
    
    Route::resources([
     'cliente' => 'General\ClienteController',
     'status' => 'General\StatusController',
     'clase_cliente' => 'General\ClaseClienteController',
     'tipo_cliente' => 'General\TipoClienteController',
     'moneda' => 'General\MonedaController',
     'operacion' => 'General\OperacionController',
     'banco' => 'General\BancoController',
    ]);
    
    Route::get('status/grupo/{grupo}','General\StatusController@statusGrupo');
    Route::get('clase_cliente/grupo/{grupo}','General\ClaseClienteController@claseClienteGrupo');
    Route::get('tipo_cliente/grupo/{grupo}','General\TipoClienteController@tipoClienteGrupo');
    Route::get('tipo_banco/grupo/{grupo}','General\TipoBancoController@tipoBancoGrupo');
    
    Route::get('moneda/grupo/{grupo}','General\MonedaController@monedaGrupo');
    Route::get('cliente/grupo/{grupo}','General\ClienteController@clienteGrupo');
    Route::get('banco/grupo/{grupo}','General\BancoController@bancoGrupo');
    Route::get('operacion/grupo/{grupo}','General\OperacionController@operacionGrupo');
    
    Route::get('ldap/{user}', 'LdapController@index');
});