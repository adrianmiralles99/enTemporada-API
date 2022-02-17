<?php

namespace app\controllers;

use Yii;
use app\models\Recetas;
use yii\data\ActiveDataProvider;

/**
 * RecetasController implements the CRUD actions for Recetas model.
 */
class RecetasController extends BaseController
{
    public $modelClass = 'app\models\Recetas';
    public $authexcept = ["index", "view", "crearreceta", "saveimg"];


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


    public function actionCrearreceta()
    {
        $model = new Recetas();

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->estado = "P";
        // $model->ingredientes = json_encode($model->ingredientes);
        // $model->pasos = json_encode($model->pasos);

        if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }

    public function actionSaveimg()
    {
    }
}
