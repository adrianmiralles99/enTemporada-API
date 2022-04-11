<?php

namespace app\controllers;
use Yii;

use app\models\Categorias;
use app\models\CategoriasSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use app\controllers\BaseController;

/**
 * CategoriasController implements the CRUD actions for Categorias model.
 */
class CategoriasController extends BaseController
{
    public $modelClass = 'app\models\Categorias';
    public $authexcept = ["index", "view"];


    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Categorias::find()->orderBy('id'),
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
    //hasta aquí
}
