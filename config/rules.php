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
        ]
    ],

];
