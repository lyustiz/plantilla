<?php

Route::middleware('jwt.auth')->group(function () {
    //CONTROL PERCEPTIVO
    // Route::get('assets_by_number/{num}', 'ControlPerceptivo\FaAssetVController@getAssetsByNumber');
    // Route::get('assets_by_tag/{num}', 'ControlPerceptivo\FaAssetVController@getAssetsByTag');
    // Route::get('addition_by_asset_number/{num}', 'ControlPerceptivo\FaAdditionsVController@getAdditionByAssetNumber');
    // Route::get('addition_by_asset_tag/{num}', 'ControlPerceptivo\FaAdditionsVController@getAdditionByAssetTag');
    // Route::post('reporte/control_perceptivo', 'ControlPerceptivo\ReporteController@generarPdf');
    // Route::get('recepcion_addition_by_number/{num}', 'ControlPerceptivo\FaAdditionsVController@getAdditionByNumber');
    // Route::get('recepcion_addition_by_tag/{num}', 'ControlPerceptivo\FaAdditionsVController@getAdditionByTag');
    
    Route::resource('control_perceptivo', 'ControlPerceptivo\ControlPerceptivoController')->parameters([
        'control_perceptivo' => 'id'
    ]);

    Route::resource('control_perceptivo_factura', 'ControlPerceptivo\FacturaController')->parameters([
        'control_perceptivo_factura' => 'id'
    ]);

    Route::get('addition_by_invoice_number/{num}', 'ControlPerceptivo\FaAdditionsVController@getAdditionByinvoiceNumber');
    Route::get('invoices_by_number/{num}', 'ControlPerceptivo\FaAssetInvoicesVController@getInvoicesByNumber');
    Route::post('reporte/control_perceptivo/recepcion', 'ControlPerceptivo\ReporteController@getRecepcionPdf');
    Route::post('reporte/control_perceptivo/control', 'ControlPerceptivo\ReporteController@getControlPdf');
    Route::post('reporte/control_perceptivo/asignacion', 'ControlPerceptivo\ReporteController@getAsignacionPdf');
});

