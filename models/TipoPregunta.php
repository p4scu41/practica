<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_pregunta".
 *
 * @property string $id_tipo_pregunta
 * @property string $descripcion
 * @property string $fecha_creado
 * @property string $fecha_modificado
 *
 * @property Pregunta[] $preguntas
 */
class TipoPregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_creado', 'fecha_modificado'], 'safe'],
            [['descripcion'], 'string', 'max' => 55]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_pregunta' => 'Id Tipo Pregunta',
            'descripcion' => 'Descripcion',
            'fecha_creado' => 'Fecha Creado',
            'fecha_modificado' => 'Fecha Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntas()
    {
        return $this->hasMany(Pregunta::className(), ['fk_tipo_pregunta' => 'id_tipo_pregunta']);
    }
}
