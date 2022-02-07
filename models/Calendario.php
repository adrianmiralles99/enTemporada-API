<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calendario".
 *
 * @property int $id_calendario
 * @property int $id_prod
 * @property int $mes
 * @property string $estado
 *
 * @property Producto $prod
 */
class Calendario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prod', 'mes', 'estado'], 'required'],
            [['id_prod', 'mes'], 'integer'],
            [['estado'], 'string'],
            [['id_prod'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::class, 'targetAttribute' => ['id_prod' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_calendario' => 'Id Calendario',
            'id_prod' => 'Id Prod',
            'mes' => 'Mes',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Prod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Producto::class, ['id' => 'id_prod']);
    }


    public function extraFields()
    {
        return ['prod'];
    }
}
