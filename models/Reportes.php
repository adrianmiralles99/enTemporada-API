<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reportes".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_usuarioreportado
 * @property int $id_comentario
 * @property string $tipo_comentario
 * @property string $motivo
 * @property string $fecha
 *
 * @property Usuarios $usuario
 * @property Usuarios $usuarioreportado
 */
class Reportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reportes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_usuarioreportado', 'id_comentario', 'tipo_comentario', 'motivo'], 'required'],
            [['id_usuario', 'id_usuarioreportado', 'id_comentario'], 'integer'],
            [['tipo_comentario', 'motivo'], 'string'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_usuarioreportado'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuarioreportado' => 'id']],
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
            'id_usuarioreportado' => 'Id Usuarioreportado',
            'id_comentario' => 'Id Comentario',
            'tipo_comentario' => 'Tipo Comentario',
            'motivo' => 'Motivo',
            'fecha' => 'Fecha',
        ];
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

    /**
     * Gets query for [[Usuarioreportado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioreportado()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_usuarioreportado']);
    }
}
