<?php

namespace app\controllers;

use app\models\Favoritos;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

/**
 * LikesController implements the CRUD actions for Favoritos model.
 */
class FavoritosController extends BaseController
{
    public $modelClass = 'app\models\Favoritos';
    public $authexcept = ["index"];

    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Favoritos::find()->orderBy('id'),
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
