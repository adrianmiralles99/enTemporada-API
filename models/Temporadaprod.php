<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temporadaprod".
 *
 * @property int $id
 * @property string $nombre
 * @property string $tipo
 * @property string $estado
 */
class Temporadaprod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temporadaprod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'tipo', 'estado'], 'required'],
            [['tipo', 'estado'], 'string'],
            [['nombre'], 'string', 'max' => 20],
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
            'tipo' => 'Tipo',
            'estado' => 'Estado',
        ];
    }
}
