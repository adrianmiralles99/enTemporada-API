<?php

namespace app\controllers;

use Yii;
use app\models\Recetas;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

/**
 * RecetasController implements the CRUD actions for Recetas model.
 */
class RecetasController extends BaseController
{
    public $modelClass = 'app\models\Recetas';
    public $except = ["index", "view"];



    public function actionRelacionadas()
    {
        return Yii::$app->db->createcommand('select * from producto')->queryAll();
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
