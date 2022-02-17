<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\Usuarios;

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

        if ($model->save()) {
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }
}
