<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UserController extends BaseController
{
    public $modelClass = 'app\models\Usuarios';
    public $authexcept = ["create", "authenticate", "register"];

    public function actionAuthenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si se envían los datos en formato raw dentro de la petición http, se recogen así:
            $params = json_decode(file_get_contents("php://input"), false);
            @$username = $params->nick;
            @$password = $params->password;

            // Si se envían los datos de la forma habitual (form-data), se reciben en $_POST:
            // return $params;
            // $username = $_POST['nick'] ?? "";
            // $password = $_POST['password'] ?? "";

            if ($u = \app\models\Usuarios::findOne(['nick' => $username]))
                if ($u->password == md5($password)) { //o crypt, según esté en la BD
                    return ['token' => $u->token, 'id' => $u->id, 'nombre' => $u->nombre];
                }
            return ['error' => 'Usuario incorrecto. ' . $username];
        }
    }

    public function actionRegister()
    {
        $model = new Usuarios();

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        $model->tipo = "U";
        $model->estado = "P";
        $model->exp = 0;
        $model->password = md5($model->password);
        $model->token = md5(date("Y-m-d") . $model->id);
        $model->fecha_cad = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))));
        $model->imagen = "default.gif";
        $model->id_ultima_receta = 0;


        if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }

    public function actionUpdateuser($id)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Usuarios::findOne($id);
        if ($uid != $model->id) //No es mío
            throw new NotFoundHttpException('Acceso no permitido');

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        }
        return $model;
    }
}
