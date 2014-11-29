<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opcion_respuesta".
 *
 * @property string $id_opcion_respuesta
 * @property string $descripcion
 * @property string $comentario
 * @property string $fecha_creado
 * @property string $fecha_modificado
 *
 * @property OpcionPregunta[] $opcionPreguntas
 * @property Pregunta[] $fkPreguntas
 * @property RespuestaSupervision[] $respuestaSupervisions
 */
class OpcionRespuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opcion_respuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_creado', 'fecha_modificado'], 'safe'],
            [['descripcion', 'comentario'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_opcion_respuesta' => 'Id Opcion Respuesta',
            'descripcion' => 'Descripcion',
            'comentario' => 'Comentario',
            'fecha_creado' => 'Fecha Creado',
            'fecha_modificado' => 'Fecha Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpcionPreguntas()
    {
        return $this->hasMany(OpcionPregunta::className(), ['fk_opcion_respuesta' => 'id_opcion_respuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkPreguntas()
    {
        return $this->hasMany(Pregunta::className(), ['id_pregunta' => 'fk_pregunta'])->viaTable('opcion_pregunta', ['fk_opcion_respuesta' => 'id_opcion_respuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaSupervisions()
    {
        return $this->hasMany(RespuestaSupervision::className(), ['fk_opcion_respuesta' => 'id_opcion_respuesta']);
    }
}
