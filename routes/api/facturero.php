<?php

Route::middleware('jwt.auth')->group(function () {
    
    /**colocar las rutas aqui */
    
});
Route::resources([
    'enteEjecutor' => 'Facturero\EntesEjecutoresController',
    'contratista'  => 'Facturero\EmpresasContratistasController',
    'objGeneral'   => 'Facturero\ProyectosGeneralesController',
    'factura'      => 'Facturero\EncDesembolsoController',

]);
