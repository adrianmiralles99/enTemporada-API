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
        if (Yii::$app->user->id) {
            $uid = Yii::$app->user->id;
            return new ActiveDataProvider([

                'query' => Likes::find()->where(['id_usuario' => $uid])->orderBy('id'),
                'pagination' => false
            ]);
        } else {
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
        $uid = Yii::$app->user->identity->id;
        $model->id_usuario = $uid;

        $existe = Likes::find()->where(["id_receta" => $model->id_receta, "id_usuario" => $model->id_usuario])->one();
        // POR SI ACASO SE PRUEBA A SPAMEAR EL BOTON DE LIKES
        if (!$existe) {
            if ($model->save()) {
                return $model;
            } else {
                return ["error" => $model->getErrors()];
            }
        }
    }

    public function actionDeletelike($id_receta)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Likes::find()->where(["id_receta" => $id_receta, "id_usuario" => $uid])->one();

        // En realidad las comprobaciones de si es mio o no, no serían necesarias,
        // solo la de si existe
        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe ese Like');
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
        $uid = Yii::$app->user->identity->id;
        $model = Likes::find()->where(['id_usuario' => $uid])->all();
        return $model;
    }
}
