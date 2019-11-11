<?php

Route::middleware('jwt.auth')->group(function () {
    
    Route::resources([
     'siniestro' => 'Fas\SiniestroController',
    ]);
    
});