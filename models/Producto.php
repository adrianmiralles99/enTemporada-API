<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property string $nombre
 * @property string $imagen
 * @property string $descripcion
 * @property string $info_nut
 * @property string $tipo
 *
 * @property Calendario[] $calendarios
 * @property Recetas[] $recetas
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'imagen', 'descripcion', 'info_nut', 'tipo'], 'required'],
            [['descripcion', 'info_nut', 'tipo'], 'string'],
            [['nombre'], 'string', 'max' => 20],
            [['imagen'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * Gets query for [[Calendarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarios()
    {
        return $this->hasMany(Calendario::class, ['id_prod' => 'id']);
    }

    /**
     * Gets query for [[Recetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecetas()
    {
        return $this->hasMany(Recetas::class, ['id_prodp' => 'id']);
    }

    public function afterFind()
    {
        $this->info_nut = json_decode($this->info_nut, true);
        return parent::afterFind();
    }


}
