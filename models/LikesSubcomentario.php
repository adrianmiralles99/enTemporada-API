<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likes_subcomentario".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_subcomentario
 *
 * @property Subcomentarios $subcomentario
 * @property Subcomentarios $usuario
 */
class LikesSubcomentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likes_subcomentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_subcomentario'], 'required'],
            [['id_usuario', 'id_subcomentario'], 'integer'],
            [['id_subcomentario'], 'exist', 'skipOnError' => true, 'targetClass' => Subcomentarios::className(), 'targetAttribute' => ['id_subcomentario' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Subcomentarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'id_subcomentario' => 'Id Subcomentario',
        ];
    }

    /**
     * Gets query for [[Subcomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcomentario()
    {
        return $this->hasOne(Subcomentarios::className(), ['id' => 'id_subcomentario']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Subcomentarios::className(), ['id' => 'id_usuario']);
    }
}
