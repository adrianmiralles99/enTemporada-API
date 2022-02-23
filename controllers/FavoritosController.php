<?php

namespace app\controllers;

use Yii;
use app\models\Favoritos;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;

/**
 * LikesController implements the CRUD actions for Favoritos model.
 */
class FavoritosController extends BaseController
{
    public $modelClass = 'app\models\Favoritos';
    public $authexcept = ["index", "view"];

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

    public function actionCreatefavorito()
    {
        $model = new Favoritos();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $uid = Yii::$app->user->identity->id;
        $model->id_usuario = $uid;
        $existe = Favoritos::find()->where(["id_receta" => $model->id_receta, "id_usuario" => $model->id_usuario])->one();

        if (!$existe) {
            if ($model->save()) {
                return $model;
            } else {
                return ["error" => $model->getErrors()];
            }
        }
    }

    public function actionDeletefavorito($id_receta)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Favoritos::find()->where(["id_receta" => $id_receta, "id_usuario" => $uid])->one();

        // En realidad las comprobaciones de si es mio o no, no serían necesarias,
        // solo la de si existe
        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe ese favorito');
        } else {
            if ($uid != $model->id_usuario) //No es mío
                throw new NotFoundHttpException('Acceso no permitido');

            if ($model->delete()) {
                return "Favorito borrado correctamente";
            }
            return $model;
        }
    }
    public function actionGetfavoritos()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Favoritos::find()->where(['id_usuario' => $uid])->all();
        return $model;
    }
}
