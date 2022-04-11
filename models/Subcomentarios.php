<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subcomentarios".
 *
 * @property int $id
 * @property int $id_comentarioprinc
 * @property int $id_usuario
 * @property string $texto
 * @property string $fecha
 * @property string $estado
 *
 * @property Comentarios $comentarioprinc
 * @property LikesSubcomentario[] $likesSubcomentarios
 * @property LikesSubcomentario[] $likesSubcomentarios0
 * @property Usuarios $usuario
 */
class Subcomentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcomentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_comentarioprinc', 'id_usuario', 'texto', 'estado'], 'required'],
            [['id_comentarioprinc', 'id_usuario'], 'integer'],
            [['texto', 'estado'], 'string'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_comentarioprinc'], 'exist', 'skipOnError' => true, 'targetClass' => Comentarios::className(), 'targetAttribute' => ['id_comentarioprinc' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_comentarioprinc' => 'Id Comentarioprinc',
            'id_usuario' => 'Id Usuario',
            'texto' => 'Texto',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Comentarioprinc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioprinc()
    {
        return $this->hasOne(Comentarios::className(), ['id' => 'id_comentarioprinc']);
    }

    /**
     * Gets query for [[LikesSubcomentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikesSubcomentarios()
    {
        return $this->hasMany(LikesSubcomentario::className(), ['id_subcomentario' => 'id']);
    }

    /**
     * Gets query for [[LikesSubcomentarios0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(LikesSubcomentario::className(), ['id_subcomentario' => 'id']);
    }
    public function getTotallikes()
    {
        return Yii::$app->db->createcommand("select count(*) as total from likes_subcomentario where id_subcomentario= '$this->id' ")->queryOne();
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
        return ["totallikes","likes", "usuario"];
    }
}
