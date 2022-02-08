<?php

namespace app\controllers;

// use yii\rest\ActiveController;
use Yii;
use yii\data\ActiveDataProvider;
use app\controllers\BaseController;
use app\models\Producto;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends BaseController
{
    public $modelClass = 'app\models\Producto';
    public $except = ["index", "view"];


    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Producto::find()->orderBy('id'),
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
// select recetas.id,titulo,id_receta, count(*) as contador from likes join recetas 
// where recetas.id=id_receta 
// group by recetas.id 
// order by contador desc 
// limit 3;