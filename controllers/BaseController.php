<?php

namespace app\controllers;

use Yii;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class BaseController extends ActiveController
{
    public $enableCsrfValidation = false;
    public $authenable = true;

    public function beforeAction($a)
    {
        header('Access-Control-Allow-Origin: *');
        return parent::beforeAction($a);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => $this->authenable,
                'Access-Control-Max-Age' => 86400
            ],
        ];

        if (!$this->authenable)
            return $behaviors;
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['options', 'authenticate'],
        ];

        return $behaviors;
    }
}