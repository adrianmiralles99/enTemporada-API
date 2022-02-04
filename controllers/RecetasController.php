<?php

namespace app\controllers;

use app\models\Recetas;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

/**
 * RecetasController implements the CRUD actions for Recetas model.
 */
class RecetasController extends ActiveController
{
    public $modelClass = 'app\models\Recetas';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['view', 'index'],
        ];
        return $behaviors;
    }

    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Recetas::find()->orderBy('id'),
            'pagination' => false
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        //Eliminamos acciones de crear y eliminar apuntes. Eliminamos update para personalizarla
        unset($actions['delete'], $actions['create'], $actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }
}
