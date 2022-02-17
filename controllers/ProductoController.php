<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\controllers\BaseController;
use app\models\Producto;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends BaseController
{
    public $modelClass = "app\models\Producto";
    public $authexcept = ["index"];


    public function actions()
    {
        $actions = parent::actions();
        //Eliminamos acciones de crear y eliminar apuntes. Eliminamos update para personalizarla
        unset($actions['delete'], $actions['create'], $actions['update']);
        // Redefinimos el método que prepara los datos en el index
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Producto::find()->orderBy('id'),
            'pagination' => false
        ]);
    }
}
