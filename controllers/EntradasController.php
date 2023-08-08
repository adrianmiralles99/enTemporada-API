<?php

namespace app\controllers;
use Yii;
use app\models\Entradas;
use yii\web\UploadedFile;
use app\models\Comentarios;
use yii\filters\VerbFilter;
//
use app\models\EntradasSearch;
use app\models\Favoritosentrada;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;

/**
 * EntradasController implements the CRUD actions for Entradas model.
 */
class EntradasController extends BaseController
{
    
    public $modelClass = 'app\models\Entradas';
    public $authexcept = ["index", "view","getfiltro"];


    public function indexProvider()
    {
        return new ActiveDataProvider([
            'query' => Entradas::find()->where(["estado" => "A"])->orderBy('fecha desc'),
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
   
    public function actionCrearentrada()
    {
        $model = new Entradas();
    
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        $model->estado = "P";
        $model->id_usuario = Yii::$app->user->identity->id;
        $fileUpload = UploadedFile::getInstanceByName('eventImage');
        $model->id_categoria = intval($model->id_categoria);
        
        var_dump($fileUpload);
        echo "<br>";
        echo ($fileUpload);
        echo "<br>";
        die();
        if (!empty($fileUpload)) {
            $model->imagen = "IMG_REC_" . rand() . "." . $fileUpload->extension;
        }

         if ($model->save()) {
            $path = realpath(dirname(getcwd())) . '/../../assets/IMG/entradas/';
            $fileUpload->saveAs($path . $model->imagen);
            return $model;
        } else {
            return ["error" => $model->getErrors()];
        }
    }

   
    public function actionUpdateentrada($id)
    {
        $uid = Yii::$app->user->identity->id;
        $model = Entradas::findOne($id);
        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe esa entrada');
        } else {
            if ($uid != $model->id_usuario) //No es mío
                throw new NotFoundHttpException('Acceso no permitido');

            $model->load(Yii::$app->getRequest()->getBodyParams(), '');
            $model->id_categoria = intval($model->id_categoria);
            $model->estado = "P";
            $fileUpload = UploadedFile::getInstanceByName('eventImage');
            $lastImagen =  $model->imagen;
            if (!empty($fileUpload)) {
                $model->imagen = "IMG_REC_" . rand() . "." . $fileUpload->extension;
            }
            if ($model->save()) {
                $path = realpath(dirname(getcwd())) . '/../../assets/IMG/entradas/';
                // LA LINEA DE ABAJO SIRVE PARA BORRAR EN CASO DE TENER NOMBRES DIFERENTES
                if (file_exists($path . $lastImagen) && !empty($fileUpload)) {
                    unlink($path . $lastImagen);
                }

                if (!empty($fileUpload)) {
                    $fileUpload->saveAs($path . $model->imagen);
                }
                // SUBIMOS LA IMAGEN

                $response = Yii::$app->getResponse();
                $response->setStatusCode(201);
            }
            return $model;
        }
    }

    public function actionDeleteentrada($id)
    {
        // Hacemos lo queramos y devolvemos información con return (un array, un objeto...)
        $uid = Yii::$app->user->identity->id;
        $model = Entradas::findOne($id);

        // En realidad las comprobaciones de si es mio o no, no serían necesarias,
        // solo la de si existe
        if (!$model) { //No existe
            throw new NotFoundHttpException('No existe esa entrada');
        } else {
            if ($uid != $model->id_usuario) //No es mío
                throw new NotFoundHttpException('Acceso no permitido');

            $path = realpath(dirname(getcwd())) . '/../../assets/IMG/entradas/';
            if (file_exists($path . $model->imagen)) {
                unlink($path . $model->imagen);
            }
            if ($model->delete()) {
                return "Entrada borrada correctamente";
            }
            return $model;
        }
    }

    //TENDRÍA QUE HACER UNA FUNCIÓN PARA CADA FILTRO CON CONDICIONALES SEGÚN LOS PARAMETROS QUE ENTREN
    public function actionGetbycategoria($id)
    {

       
        $model = Entradas::find()->where(["id_categoria" => $id, "estado" => "A"])->all();
        if (!$model) {
            $model = Entradas::find()->all();
        }
        return $model;
        
        $model = Entradas::find()->all();
        return $model;
    }
        //AQUÍ FALTARÍAN LOS FILTROS DE LIKES Y COMENTARIOS, LO DE FAVORITOS, ETC

    public function actionGetfiltro($id_categoria = null, $opcion = null)
    {

        
        
        //a OPCION le pasaremos un ASC ,DESC, LIKES, COMENTARIOS
        if ($id_categoria && $opcion==null ||$id_categoria && !$opcion) {
           
            $model = Entradas::find()->where(["id_categoria" => $id_categoria, "estado" => "A"])->all();
            if (!$model) {
                $model = Entradas::find()->where(["estado" => "A"])->all();
            }
          
            return $model;
   
        }
        if ($opcion) {
            if ($opcion == "ASC" || $opcion == "DESC"){
                $order = "fecha " . $opcion;
                
                if ($id_categoria){
                    $model = Entradas::find()->where(["estado" => "A", "id_categoria" => $id_categoria])->orderBy($order)->all();

                }else{
                    $model = Entradas::find()->where(["estado" => "A"])->orderBy($order)->all();

                }
                return $model;

            }
            if ($opcion == "LIKES"){
                if ($id_categoria){
                    /*
                    $model = Yii::$app->db->createcommand("
                    SELECT *, count(likes_entrada.id_entrada) as totallikes from entradas JOIN likes_entrada ON entradas.id= likes_entrada.id_entrada 
                    where entradas.estado='A' AND id_categoria = $id_categoria GROUP BY  entradas.id,titulo ORDER BY COUNT(likes_entrada.id_entrada) desc
                    ;")->queryAll();*/
                    $model =  Entradas::find()->joinWith('likes', true, 'INNER JOIN')->
                    where(["entradas.estado" => "A", "id_categoria" => $id_categoria])->groupBy("entradas.id")->orderBy("count(id_entrada) desc")->all();
                }else{
                    /*
                    $model = Yii::$app->db->createcommand("
                    SELECT *, count(likes_entrada.id_entrada) as totallikes from entradas JOIN likes_entrada ON entradas.id= likes_entrada.id_entrada 
                    where entradas.estado='A' GROUP BY  entradas.id,titulo ORDER BY COUNT(likes_entrada.id_entrada) desc
                    ;")->queryAll();*/
                    $model =  Entradas::find()->joinWith('likes', true, 'INNER JOIN')->
                    where(["entradas.estado" => "A"])->groupBy("entradas.id")->orderBy("count(id_entrada) desc")->all();

                }
                return $model;
            }
            if ($opcion == "COMENTARIOS"){
                if ($id_categoria){/*
                    $model = Yii::$app->db->createcommand("
                    SELECT *, count(comentarios.id_entrada) as totalcomentarios 
                    from entradas JOIN comentarios ON entradas.id= comentarios.id_entrada
                    where entradas.estado='A' AND id_categoria = $id_categoria GROUP BY  entradas.id,titulo ORDER BY COUNT(comentarios.id_entrada) 
                    desc
                    ;")->queryAll();*/
                    $model =  Entradas::find()->joinWith('comentarios', true, 'INNER JOIN')->
                    where(["entradas.estado" => "A", "id_categoria" => $id_categoria])->groupBy("entradas.id")->orderBy("count(comentarios.id_entrada) desc")->all();

                }else{
                  //  $model = Entradas::find()->join('comentarios', 'entradas.id = comentarios.id_entrada')->where(["estado" => "A"])->all();
                  $model =  Entradas::find()->joinWith('comentarios', true, 'INNER JOIN')->where(["entradas.estado" => "A"])->groupBy("entradas.id")->orderBy("count(comentarios.id_entrada) desc")->all();
                    /*
                    $model = Yii::$app->db->createcommand("
                    SELECT *, count(comentarios.id_entrada) as totalcomentarios 
                    from entradas JOIN comentarios ON entradas.id= comentarios.id_entrada
                    where entradas.estado='A' GROUP BY entradas.id,titulo ORDER BY COUNT(comentarios.id_entrada) 
                    desc
                    ;")->queryAll();
                    */
                }  
                return $model;
            }

           
        }
        
        
        $model = Entradas::find()->where(["estado" => "A"])->orderBy('fecha desc')->all();

        return $model;
    }


    public function actionGetfav()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Entradas::find()->where(["in", "id", Favoritosentrada::find()->select('id_entrada')->where(['id_usuario' => $uid])])->all();
        return $model;
    }

    public function actionGetmias()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Entradas::find()->where(["id_usuario" => $uid])->all();

        return $model;
    }

    public function actionUltimaentrada()
    {
        $ultima = Yii::$app->user->identity->id_ultima_entrada;
        $model = Yii::$app->db->createcommand("select entradas.*, u.nick, u.imagen as 'usuario_img' from entradas join usuarios as u
         where entradas.id=$ultima and id_usuario= u.id;")->queryOne();
        return $model;
    }

    public function actionPopularentrada()
    {
        $uid = Yii::$app->user->identity->id;
        $model = Yii::$app->db->createcommand("
        select entradas.*, u.nick, u.imagen as 'usuario_img' from entradas join usuarios as u 
        where entradas.id_usuario=u.id and 
        entradas.id= (select id_entrada from likes_entrada where id_entrada in 
        (select id from entradas where id_usuario=$uid)
        group by id_entrada order by count(*) desc limit 1);")->queryOne();

        return $model;
    }

}
