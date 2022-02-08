<?php
return  [
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => ['usuarios', 'calendario', 'favoritos', 'likes', 'recetas', 'producto', 'temporadaprod'],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['user'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST authenticate' => 'authenticate',
            'OPTIONS authenticate' => 'authenticate',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['recetas'],
        'pluralize' => false,
        'extraPatterns' => [
            'OPTIONS relacionadas' => 'relacionadas',
            'GET relacionadas' => 'relacionadas'
        ]
    ]  

];
