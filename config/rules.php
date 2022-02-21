<?php
return  [
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => ['user', 'calendario', 'favoritos', 'likes', 'recetas', 'producto', "prodactuales"],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['user'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST authenticate' => 'authenticate',
            'OPTIONS authenticate' => 'authenticate',
            'POST register' => 'register',
            'OPTIONS register' => 'register',
            'PUT updateuser' => 'updateuser',
            'OPTIONS updateuser' => 'updateuser',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['recetas'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST crearreceta' => 'crearreceta',
            'OPTIONS crearreceta' => 'crearreceta',
            'PUT updatereceta' => 'updatereceta',
            'OPTIONS updatereceta' => 'updatereceta',
            'DELETE deletereceta' => 'deletereceta',
            'OPTIONS deletereceta' => 'deletereceta',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['likes'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST createlike' => 'createlike',
            'OPTIONS createlike' => 'createlike',
            'DELETE deletelike' => 'deletelike',
            'OPTIONS deletelike' => 'deletelike',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['favoritos'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST createfavorito' => 'createfavorito',
            'OPTIONS createfavorito' => 'createfavorito',
            'DELETE deletefavorito' => 'deletefavorito',
            'OPTIONS deletefavorito' => 'deletefavorito',
        ]
    ],



];
