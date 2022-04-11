<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\Entradas;
use app\models\Comentarios;
use yii\filters\VerbFilter;
use app\models\Subcomentarios;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;
use app\models\SubcomentariosSearch;

/**
 * SubcomentariosController implements the CRUD actions for Subcomentarios model.
 */
class SubcomentariosController extends BaseController
{
    public $modelClass = 'app\models\Subcomentarios';
    public $authexcept = ["index", "view", "getsubcomentarios"];


    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Subcomentarios::find()->where(["estado" => "V"])->orderBy('fecha desc'),
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
    public function actionGetsubcomentarios($idcomentarioprinc){


       // echo "entra"; die();
        $model = new Subcomentarios();

        if ($idcomentarioprinc){
            $model = Subcomentarios::find()->where(["estado" => "V", "id_comentarioprinc" => $idcomentarioprinc ])->orderBy('fecha desc')->all();
            return $model;

        }else{
            throw new NotFoundHttpException('Id de comentario principal, no encontrada.');

        }

    }
    public function actionCrearsubcomentario()
    {
        $model = new Subcomentarios();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        //var_dump($model);
        //die();
        $model->estado = "V";
        $model->id_usuario = Yii::$app->user->identity->id;

         if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }
    public function actionOcultarsubcomentario($id)
    {
        //solo se puede ocultar un subcomentario  si eres el propitario de la receta, 
        //el propietario del comentario principal (si el subcomentario no es propiedad del propietario de la entrada) o el propietario del subcomentario
        $model = Subcomentarios::findOne($id);
        $model2 = Comentarios::findOne($model->id_comentarioprinc);
        $model3 = Entradas::findOne($model2->id_entrada);
        $uid = Yii::$app->user->identity->id;
        $id_propietarioentrada = $model3->id_usuario;
        $id_propietariocomentario = $model2->id_usuario;
        $id_propietariosubcomentario = $model->id_usuario;
       // echo "Id del que pulsa:  $uid  \n Id del prop entrada:  $id_propietarioentrada  \n";
       // echo "Id del prop coment princ: $id_propietariocomentario \n Id del prop subcomment:   $id_propietariosubcomentario  \n";
        
        if ($id_propietarioentrada == $uid || ($id_propietariocomentario == $uid && $id_propietariosubcomentario != $id_propietarioentrada) ||$id_propietariosubcomentario == $uid){           
            $model->estado = "I";  
            $model->fecha = $model->fecha;
            
        }else if ($id_propietariocomentario == $id_propietarioentrada){
            throw new NotFoundHttpException('Acceso no permitido, no puedes eliminar subcomentarios si son del propietario de la entrada');
        }
       
        else{
            throw new NotFoundHttpException('Acceso no permitido, no es ni el propietario de la receta ni el propietario del comentario principal, ni el propietario del subcomentario');
        }
        if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }

    }
   
   

}