<?php

return [

    'paths' => [
        'models'      => 'Models/',
        'controllers' => 'Http/Controllers/',
        'views'       => 'resources/assets/js/pages/',
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