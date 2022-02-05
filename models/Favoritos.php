<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favoritos".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_receta
 *
 * @property Recetas $receta
 * @property Recetas $receta0
 * @property Usuarios $usuario
 */
class Favoritos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_receta'], 'required'],
            [['id_usuario', 'id_receta'], 'integer'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_receta'], 'exist', 'skipOnError' => true, 'targetClass' => Recetas::className(), 'targetAttribute' => ['id_receta' => 'id']],
            [['id_receta'], 'exist', 'skipOnError' => true, 'targetClass' => Recetas::className(), 'targetAttribute' => ['id_receta' => 'id']],
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
            'id_receta' => 'Id Receta',
        ];
    }

    /**
     * Gets query for [[Receta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceta()
    {
        return $this->hasOne(Recetas::className(), ['id' => 'id_receta']);
    }

    /**
     * Gets query for [[Receta0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceta0()
    {
        return $this->hasOne(Recetas::className(), ['id' => 'id_receta']);
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
