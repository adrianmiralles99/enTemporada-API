<?php

namespace app\controllers;

use yii\rest\ActiveController;
use app\controllers\BaseController;

/**
 * CalendarioController implements the CRUD actions for Calendario model.
 */
class CalendarioController extends BaseController
{
    public $modelClass = 'app\models\Calendario';
    public $except = ["index", "view"];
    
    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Calendario::find()->orderBy('id'),
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
