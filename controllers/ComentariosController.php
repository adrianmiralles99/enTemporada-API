<?php

namespace app\controllers;
use Yii;
use app\models\Entradas;
use app\models\Comentarios;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\ComentariosSearch;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;


/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends BaseController
{
    public $modelClass = 'app\models\Comentarios';
    public $authexcept = ["index", "view", "getcomentarios"];


    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Comentarios::find()->where(["estado" => "V"])->orderBy('id'),
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
    //hasta aquí.
    public function actionGetcomentarios($identrada){
        $model = new Comentarios();

        if ($identrada){
            $model = Comentarios::find()->where(["estado" => "V", "id_entrada" => $identrada ])->orderBy('fecha desc')->all();
            return $model;

        }else{
            $model = Comentarios::find()->where(["estado" => "V"])->orderBy('fecha desc')->all();
            return $model;
        }

    }
    public function actionCrearcomentario()
    {
        $model = new Comentarios();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        //var_dump($model);
        //die();
        $model->estado = "V";
        $model->id_usuario = Yii::$app->user->identity->id;
        $model->id_entrada = intval($model->id_entrada);

         if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }
    public function actionOcultarcomentario($id)
    {
        //solo se puede ocultar un comentario si eres el propitario de la receta o el propietario del comentario
        $model = Comentarios::findOne($id);
        $model2 = Entradas::findOne($model->id_entrada);
        $uid = Yii::$app->user->identity->id;
        $id_propietarioentrada = $model2->id_usuario;
        $id_propietariocomentario = $model->id_usuario;
        if ($id_propietarioentrada == $uid || $id_propietariocomentario == $uid){
            $model->estado = "I";
            $model->fecha = $model->fecha;

        }else{
            throw new NotFoundHttpException('Acceso no permitido, no es ni el propietario de la receta ni el propietario del comentario');
        }
        
        if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }

    }
   
   

}
