<?php

namespace app\controllers;

use app\models\Likes;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

/**
 * LikesController implements the CRUD actions for Likes model.
 */
class LikesController extends BaseController 
{
    public $modelClass = 'app\models\Likes';
    public $authexcept = ["index"];
    
    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Likes::find()->orderBy('id'),
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
