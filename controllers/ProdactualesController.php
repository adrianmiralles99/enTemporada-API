<?php

namespace app\controllers;

// use yii\rest\ActiveController;
use Yii;
use yii\data\ActiveDataProvider;
use app\controllers\BaseController;
use app\models\Prodactuales;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProdactualesController extends BaseController
{
    public $modelClass = 'app\models\Prodactuales';
    public $except = ["index", "view"];



    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Prodactuales::find()->orderBy('id'),
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
