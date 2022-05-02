<?php

namespace app\controllers;
use Yii;

use app\models\Reportes;
use app\models\ReportesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BaseController;

/**
 * ReportesController implements the CRUD actions for Reportes model.
 */
class ReportesController extends BaseController
{

    public $modelClass = 'app\models\Reportes';
    //public $authexcept = ["index", "view"];
    /**
     * Lists all Reportes models.
     *
     */

    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Reportes::find()->orderBy('id'),
            'pagination' => false
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        //Eliminamos acciones de crear.
        unset( $actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    /**
     * Creates a new Reportes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Reportes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionCrearreporte()
    {
        $model = new Reportes();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        //var_dump($model);
        //die();
        $model->id_usuario = Yii::$app->user->identity->id;
        $model->id_usuarioreportado = intval($model->id_usuarioreportado);
        $model->id_comentario = intval($model->id_comentario);

         if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }
  
}
