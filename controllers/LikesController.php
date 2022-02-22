<?php

namespace app\controllers;

use Yii;
use app\models\Likes;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;
use app\models\Usuarios;

/**
 * LikesController implements the CRUD actions for Likes model.
 */
class LikesController extends BaseController
{
    public $modelClass = 'app\models\Likes';
    public $authexcept = ["index", "view"];

    public function indexProvider()
    {
        $uid = Yii::$app->user->isGuest;
        var_dump($uid);
        if( Yii::$app->user->identity ){
            
            return new ActiveDataProvider([
                'query' => Likes::find()->where(["id_usuario"=> $uid])->orderBy('id'),
                'pagination' => false
            ]);
        }else{
            echo("hi");
            return new ActiveDataProvider([
                'query' => Likes::find()->orderBy('id'),
                'pagination' => false
            ]);
        }
       
    }

    public function actions()
    {
        $actions = parent::actions();
        //Eliminamos acciones de crear y eliminar apuntes. Eliminamos update para personalizarla
        unset($actions['delete'], $actions['create'], $actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function actionCreatelike()
    {
        $model = new Likes();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }

    public function actionDeletelike($id)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Likes::findOne($id);

        // En realidad las comprobaciones de si es mio o no, no serían necesarias,
        // solo la de si existe
        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe esa receta');
        } else {
            if ($uid != $model->id_usuario) //No es mío
                throw new NotFoundHttpException('Acceso no permitido');

            if ($model->delete()) {
                return "Like borrado correctamente";
            }
            return $model;
        }
    }

    public function actionGetlikes()
    {
        $model = Likes::find()->where(["id_receta" => 2])->all();
        return $model;
    }
}
