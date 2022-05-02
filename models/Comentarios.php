<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_entrada
 * @property string $texto
 * @property string $estado
 * @property string $fecha
 *
 * @property Entradas $entrada
 * @property Likescomentario[] $likesComentarios
 * @property Subcomentarios[] $subcomentarios
 * @property Usuarios $usuario
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
    
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_entrada', 'texto', 'estado'], 'required'],
            [['id_usuario', 'id_entrada'], 'integer'],
            [['texto', 'estado'], 'string'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_entrada'], 'exist', 'skipOnError' => true, 'targetClass' => Entradas::className(), 'targetAttribute' => ['id_entrada' => 'id']],
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
            'id_entrada' => 'Id Entrada',
            'texto' => 'Texto',
            'estado' => 'Estado',
            'fecha' => 'Fecha',
        ];
    }



    /**
     * Gets query for [[Entrada]].
     *
     * @return \yii\db\ActiveQuery
     */

 
 
    public function getEntrada()
    {
        return $this->hasOne(Entradas::className(), ['id' => 'id_entrada']);
    }

    /**
     * Gets query for [[Likescomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTotallikes()
    {
        return Yii::$app->db->createcommand("select count(*) as total from likes_comentario where id_comentario= '$this->id' ")->queryOne();
    }
    public function getLikes()
    {
        return $this->hasMany(Likescomentario::className(), ['id_comentario' => 'id']);
    }
    public function getTotalsubcomentarios(){
        return Yii::$app->db->createcommand("select count(*) as total from subcomentarios where id_comentarioprinc= '$this->id' ")->queryOne();

    }

    /**
     * Gets query for [[Subcomentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcomentarios()
    {
        return $this->hasMany(Subcomentarios::className(), ['id_comentarioprinc' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_usuario']);
    }

    public function extraFields()
    {
        return ["totallikes","likes", "usuario", "totalsubcomentarios", "subcomentarios"];
    }
}
