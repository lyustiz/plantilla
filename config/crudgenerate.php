<?php

return [

    'paths' => [
        'models'      => 'Models/',
        'controllers' => 'Http/Controllers/',
        'views'       => 'resources/js/pages/',
        'routes'      => 'resources/js/router/index.js',
        'apis'        => 'routes/api.php',
        'templates'   => 'resources/templates/'
    ],

    'cols' => [
        'createdAt'   => 'fe_creado',
        'updatedAt'   => 'fe_actualizado',
        'hiddenCols'  => ['fe_creado', 'fe_actualizado']
    ],

    'actions' => [
        'index', 'show', 'store', 'edit', 'update', 'destroy'
    ]
];