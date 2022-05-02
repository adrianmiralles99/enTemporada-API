<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entradas".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_categoria
 * @property string $titulo
 * @property string $fecha
 * @property string $estado
 * @property string $texto
 * @property string $imagen
 *
 * @property Categorias $categoria
 * @property Comentarios[] $comentarios
 * @property Favoritosentrada[] $favoritosentradas
 * @property Likesentrada[] $likesentradas
 * @property Usuarios $usuario
 */
class Entradas extends \yii\db\ActiveRecord
{

    public $eventImage;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entradas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_categoria', 'titulo', 'estado', 'texto', 'imagen'], 'required'],
            [['id_usuario', 'id_categoria'], 'integer'],
            [['fecha'], 'safe'],
            [['estado', 'texto'], 'string'],
            [['titulo'], 'string', 'max' => 75],
            [['imagen'], 'string', 'max' => 40],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['id_categoria' => 'id']],
            [['eventImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'id_categoria' => 'Id Categoria',
            'titulo' => 'Titulo',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
            'texto' => 'Texto',
            'imagen' => 'Imagen',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'id_categoria']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['id_entrada' => 'id']);
    }

    /**
     * Gets query for [[Favoritosentradas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favoritosentrada::className(), ['id_entrada' => 'id']);
    }

    /**
     * Gets query for [[Likesentrada]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likesentrada::class, ['id_entrada' => 'id']);
    }

    public function getTotallikes()
    {
        return Yii::$app->db->createcommand("select count(*) as total from likes_entrada where id_entrada= '$this->id' ")->queryOne();
    }
    public function getTotalcomentarios(){
        return Yii::$app->db->createcommand("select count(*) as total from comentarios where id_entrada= '$this->id' ")->queryOne();

    }

    
    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
   
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'id_usuario']);
    }
    public function getNick()
    {
        return Yii::$app->db->createcommand("select nick, imagen from usuarios where id= '$this->id_usuario' ")->queryOne();
    }

    public function extraFields()
    {
        return ["categoria","nick", "totallikes",  "likes", "favoritos", "usuario", "totalcomentarios"];
    }
}
