<?php

namespace app\controllers;

use app\models\Temporadaprod;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

/**
 * TemporadaprodController implements the CRUD actions for Likes model.
 */
class TemporadaprodController extends ActiveController
{
    public $modelClass = 'app\models\Temporadaprod';

    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Temporadaprod::find()->orderBy('id'),
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
