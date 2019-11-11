<?php

Route::middleware('jwt.auth')->group(function () {
    
    Route::resources([
     'subasta' => 'Dicom\SubastaController',
     'solicitud' => 'Dicom\SolicitudController',
     'detsolicitud' => 'Dicom\DetSolicitudController',
    ]);
    
    Route::get('file/write/{id}/{cod}/{num}', 'Dicom\FileWriterController@index');
    Route::get('file/{id}/{cod}/{num}/{user}', 'Dicom\FileReaderController@index');
    Route::get('file/store/{id}/{cod}/{num}/{user}', 'Dicom\FileReaderController@store');
    
    Route::get('solicitudes/{id}', 'Dicom\SolicitudController@obtenerSolicitudes');   
    Route::get('ordenacion/{id}', 'Dicom\OrdenacionController@obtenerOrdenacion');  
    
});

Route::get('reporte/dicom/{id_subasta}', 'Dicom\ReporteController@index');