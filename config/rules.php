<?php
return  [
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => ['user', 'calendario', 'favoritos', 'likes', 'recetas', 'producto', "prodactuales", "entradas","categorias", "likesentrada", "favoritosentrada","comentarios", "subcomentarios", "likescomentario","likessubcomentario","reportes"],
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
            'GET bytipo' => 'bytipo',
            'OPTIONS bytipo' => 'bytipo',
            'PUT updatereceta' => 'updatereceta',
            'OPTIONS updatereceta' => 'updatereceta',
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
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['entradas'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST crearentrada' => 'crearentrada',
            'OPTIONS crearentrada' => 'crearentrada',
            'PUT updateentrada' => 'updateentrada',
            'OPTIONS updateentrada' => 'updateentrada',
            'DELETE deleteentrada' => 'deleteentrada',
            'OPTIONS deleteentrada' => 'deleteentrada',
            'GET getbyCategoria' => 'getbycategoria',
            'OPTIONS getbycategoria' => 'getbycategoria',
            'GET getfiltro' => 'getfiltro',
            'OPTIONS getfiltro' => 'getfiltro',
            'GET ultimaentrada' => 'ultimaentrada',
            'OPTIONS ultimaentrada' => 'ultimaentrada',
            'GET popularentrada' => 'popularentrada',
            'OPTIONS popularentrada' => 'popularentrada',
            'GET getfav' => 'getfav',
            'OPTIONS getfav' => 'getfav',
            'GET getmias' => 'getmias',
            'OPTIONS getmias' => 'getmias',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['likesentrada'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST createlike' => 'createlike',
            'OPTIONS createlike' => 'createlike',
            'DELETE deletelike' => 'deletelike',
            'OPTIONS deletelike' => 'deletelike',
            'GET getlikes' => 'getlikes',
            'OPTIONS getlikes' => 'getlikes',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['favoritosentrada'],
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
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['likescomentario'],
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
        'controller' => ['likessubcomentario'],
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
        'controller' => ['comentarios'],
        'pluralize' => false,
        'extraPatterns' => [
            'GET getcomentarios' => 'getcomentarios',
            'OPTIONS getcomentarios' => 'getcomentarios',
            'POST crearcomentario' => 'crearcomentario',
            'OPTIONS crearcomentario' => 'crearcomentario',
            'PUT ocultarcomentario' => 'ocultarcomentario',
            'OPTIONS ocultarcomentario' => 'ocultarcomentario',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['subcomentarios'],
        'pluralize' => false,
        'extraPatterns' => [
            'GET getsubcomentarios' => 'getsubcomentarios',
            'OPTIONS getsubcomentarios' => 'getsubcomentarios',
            'POST crearsubcomentario' => 'crearsubcomentario',
            'OPTIONS crearsubcomentario' => 'crearsubcomentario',
            'PUT ocultarsubcomentario' => 'ocultarsubcomentario',
            'OPTIONS ocultarsubcomentario' => 'ocultarsubcomentario',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['reportes'],
        'pluralize' => false,
        'extraPatterns' => [
            'POST crearreporte' => 'crearreporte',
            'OPTIONS crearreporte' => 'crearreporte',
        ]
    ],




];
