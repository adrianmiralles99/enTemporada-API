<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favoritos_entrada".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_entrada
 *
 * @property Entradas $entrada
 * @property Usuarios $usuario
 */
class FavoritosEntrada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos_entrada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_entrada'], 'required'],
            [['id_usuario', 'id_entrada'], 'integer'],
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
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_usuario']);
    }
}
