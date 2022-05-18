<?php

namespace app\controllers;
use Yii;
use app\models\Notificaciones;
use app\models\NotificacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BaseController;
use yii\data\ActiveDataProvider;


/**
 * NotificacionesController implements the CRUD actions for Notificaciones model.
 */
class NotificacionesController extends BaseController
{
    public $modelClass = 'app\models\Notificaciones';
    public $authexcept = ["index"];


    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Notificaciones::find()->orderBy('id'),
            'pagination' => false
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        //Eliminamos acciones de crear y eliminar apuntes. Eliminamos update para personalizarla
        unset($actions['delete'], $actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function actionGetmias()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Notificaciones::find()->where(["id_usuario" => $uid])->orderBy('id DESC' )->all();

        return $model;
    }
  
    /**
     * Creates a new Notificaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    

    public function actionCrearnotificacion($id, $asunto, $tipo)
    {
        $model2 = new Notificaciones();

        $model2->load(Yii::$app->getRequest()->getBodyParams(), '');

        $model = new Notificaciones();
        if ($asunto =="Puntos"){
            $model->asunto="Puntos";
            if ($tipo=="entrada"){
                $model->texto= "+ 25 puntos de experiencia de chef por subir una entrada!";
            }else if ($tipo =="receta"){
                $model->texto= "+ 25 puntos de experiencia de chef por subir una receta!";
            }else if ($tipo =="comentario"){
                $model->texto= "+ 5 puntos de experiencia de chef por subir un comentario!";
            }else{
                $model->texto= "+ 3 puntos de experiencia de chef por subir un subcomentario!";
            }
        } 
        else if ($asunto =="Comentario"){
            $model->asunto="Comentario";
            $model->texto = $model2->texto;
        }else if ($asunto == "Subcomentario"){
            $model->asunto="Subcomentario";
            $model->texto = $model2->texto;

        }

      
        $model->id_usuario = $id;
         if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }

   
    public function actionDeletenotificacion($id)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Notificaciones::findOne($id);

        // En realidad las comprobaciones de si es mio o no, no serían necesarias,
        // solo la de si existe
        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe esa notificación');
        } else {
            if ($uid != $model->id_usuario) //No es mío
                throw new NotFoundHttpException('Acceso no permitido');
            if ($model->delete()) {
                return "Notificación borrada correctamente";
            }
            return $model;
        }
    }

}
