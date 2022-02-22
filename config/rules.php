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
            'GET recetauser' => 'recetauser',
            'OPTIONS recetauser' => 'recetauser',
            'GET ultimareceta' => 'ultimareceta',
            'OPTIONS ultimareceta' => 'ultimareceta',
            'GET popularreceta' => 'popularreceta',
            'OPTIONS popularreceta' => 'popularreceta',
            'GET getfav' => 'getfav',
            'OPTIONS getfav' => 'getfav',
            'GET getmias' => 'getmias',
            'OPTIONS getmias' => 'getmias',
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
            'GET getlikes' => 'getlikes',
            'OPTIONS getlikes' => 'getlikes',
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
            'GET getfavoritos' => 'getfavoritos',
            'OPTIONS getfavoritos' => 'getfavoritos',
            'DELETE deletefavorito' => 'deletefavorito',
            'OPTIONS deletefavorito' => 'deletefavorito',
        ]
    ],
    



];
