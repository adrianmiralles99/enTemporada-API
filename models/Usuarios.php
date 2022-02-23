<?php

namespace app\models;

use Yii;
use app\models\Likes;
use app\models\Recetas;
use app\models\Favoritos;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $nick
 * @property string $correo
 * @property string $password
 * @property string $imagen
 * @property string $descripcion
 * @property string $localidad
 * @property string $direccion
 * @property string $tipo
 * @property string $estado
 * @property string|null $token
 * @property string|null $fecha_cad
 * @property int|null $exp
 * @property int|null $id_ultima_receta
 *
 * @property Favoritos[] $favoritos
 * @property Likes[] $likes
 * @property Recetas[] $recetas
 * @property Recetas[] $recetas0
 */

class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    static $tipoUsuarios = ["U" => "Usuario",  "A" => "Administrdor"];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellidos', 'nick', 'correo', 'password', 'localidad', 'direccion', 'tipo', 'estado'], 'required'],
            [['descripcion', 'tipo', 'estado'], 'string'],
            [['fecha_cad', 'imagen'], 'safe'],
            [['exp', 'id_ultima_receta'], 'integer'],
            [['nombre', 'localidad'], 'string', 'max' => 20],
            [['apellidos', 'imagen', 'token'], 'string', 'max' => 40],
            [['nick'], 'string', 'max' => 12],
            [['correo', 'direccion'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'nick' => 'Nick',
            'correo' => 'Correo',
            'password' => 'Password',
            'imagen' => 'Imagen',
            'descripcion' => 'Descripcion',
            'localidad' => 'Localidad',
            'direccion' => 'Direccion',
            'tipo' => 'Tipo',
            'estado' => 'Estado',
            'token' => 'Token',
            'fecha_cad' => 'Fecha Cad',
            'exp' => 'Exp',
            'id_ultima_receta' => 'Id Ultima Receta',
        ];
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favoritos::class, ['id_usuario' => 'id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::class, ['id_usuario' => 'id']);
    }

    public function getNumLikes()
    {
        return $this->hasMany(Likes::class, ['id_usuario' => 'id']);
    }

    /**
     * Gets query for [[Recetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecetas()
    {
        return $this->hasMany(Recetas::class, ['id_usuario' => 'id']);
    }

    /**
     * Gets query for [[Recetas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUltimareceta()
    {
        return $this->hasOne(Recetas::class, ['id_usuario' => 'id_ultima_receta']);
    }

    public function getTotallikes()
    {
        return Yii::$app->db->createcommand("select count(*) as total from likes where id_usuario='$this->id'")->queryOne();
    }

    public function getTotalfavoritos()
    {
        return Yii::$app->db->createcommand("select count(*) as total from favoritos where id_usuario='$this->id'")->queryOne();
    }

    public static function findByUsername($username)
    {
        return static::findOne(['nick' => $username]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {

        $usuario = self::findOne(['token' => $token]);

        // Por si caduca
        if ($usuario && $usuario->fecha_cad <= date("Y-m-d")) {
            $usuario->token = md5(date("Y-m-d") . $usuario->id);

            // Suma al mes actual 1 mes mas
            $fecha = date('Y-m-d');
            $nuevafecha = strtotime('+1 month', strtotime($fecha));
            $nuevafecha = date('Y-m-d', $nuevafecha);
            $usuario->fecha_cad = $nuevafecha;

            $usuario->save();
        }
        return $usuario;
    }

    // Comprueba que el password que se le pasa es correcto
    public function validatePassword($password)
    {
        return $this->password === md5($password); // Si se utiliza otra función de encriptación distinta a md5, habrá que cambiar esta línea
    }

    public function getTipoText()
    {
        return self::$tipoUsuarios[$this->tipo];
    }
    public function extraFields()
    {
        return ["recetas", "ultimareceta", "totallikes", "totalfavoritos"];
    }
}
