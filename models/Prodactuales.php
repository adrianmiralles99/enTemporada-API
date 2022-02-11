<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prodactuales".
 *
 * @property int $id
 * @property string $nombre
 * @property string $imagen
 * @property string $descripcion
 * @property string $info_nut
 * @property string $tipo
 * @property string $color
 * 
 * @property Calendario[] $calendarios
 */
class Prodactuales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prodactuales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'imagen', 'descripcion', 'info_nut', 'tipo', 'color'], 'required'],
            [['descripcion', 'info_nut', 'tipo'], 'string'],
            [['nombre'], 'string', 'max' => 20],
            [['imagen'], 'string', 'max' => 100],
            [['color'], 'string', 'max' => 40],
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
            'imagen' => 'Imagen',
            'descripcion' => 'Descripcion',
            'info_nut' => 'Info Nut',
            'tipo' => 'Tipo',
            'color' => 'Color',
        ];
    }

    public function getCalendario()
    {
        return $this->hasMany(Calendario::class, ['id_prod' => 'id']);
    }


    public function extraFields()
    {
        return ["calendario"];
    }
}
