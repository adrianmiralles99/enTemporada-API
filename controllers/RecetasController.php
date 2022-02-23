<?php

namespace app\controllers;

use Yii;
use app\models\Likes;
use app\models\Recetas;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;
use app\models\Favoritos;

/**
 * RecetasController implements the CRUD actions for Recetas model.
 */
class RecetasController extends BaseController
{
    public $modelClass = 'app\models\Recetas';
    public $authexcept = ["index", "view"];


    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Recetas::find()->where(["estado"=>"A"])->orderBy('id'),
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


    public function actionCrearreceta()
    {
        $model = new Recetas();

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->estado = "P";
        $model->id_usuario = Yii::$app->user->identity->id;

        if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }

    public function actionUpdatereceta($id)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Recetas::findOne($id);

        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe esa receta');
        } else {
            if ($uid != $model->id_usuario) //No es mío
                throw new NotFoundHttpException('Acceso no permitido');

            $model->load(Yii::$app->getRequest()->getBodyParams(), '');
            if ($model->save()) {
                $response = Yii::$app->getResponse();
                $response->setStatusCode(201);
            }
            return $model;
        }
    }

    public function actionDeletereceta($id)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Recetas::findOne($id);

        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe esa receta');
        } else {

            if ($uid != $model->id_usuario) //No es mío
                throw new NotFoundHttpException('Acceso no permitido');

            if ($model->delete()) {
                return "Receta borrada correctamente";
            }
            return $model;
        }
    }

    public function actionGetfav()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Recetas::find()->where(["in", "id", Favoritos::find()->select('id_receta')->where(['id_usuario' => $uid])])->all();
        return $model;
    }

    public function actionGetmias()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Recetas::find()->where(["id_usuario" => $uid])->all();

        return $model;
    }

    public function actionUltimareceta()
    {
        $ultima = Yii::$app->user->identity->id_ultima_receta;
        $model = Yii::$app->db->createcommand("select recetas.*, u.nick, u.imagen as 'usuario_img' from recetas join usuarios as u
         where recetas.id=$ultima and id_usuario= u.id;")->queryOne();
        return $model;
    }

    public function actionPopularreceta()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Yii::$app->db->createcommand("
        select recetas.*, u.nick, u.imagen as 'usuario_img' from recetas join usuarios as u 
        where recetas.id_usuario=u.id and recetas.id=
        (select id_receta from likes where id_receta in 
        (select id from recetas where id_usuario=$uid)
        group by id_receta order by count(*) desc limit 1);")->queryOne();

        return $model;
    }
}
