<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opcion_pregunta".
 *
 * @property string $fk_pregunta
 * @property string $fk_opcion_respuesta
 * @property integer $es_opcion_ideal
 * @property integer $valor_ideal
 *
 * @property Pregunta $fkPregunta
 * @property OpcionRespuesta $fkOpcionRespuesta
 */
class OpcionPregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opcion_pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_pregunta', 'fk_opcion_respuesta'], 'required'],
            [['fk_pregunta', 'fk_opcion_respuesta', 'es_opcion_ideal', 'valor_ideal'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fk_pregunta' => 'Fk Pregunta',
            'fk_opcion_respuesta' => 'Fk Opcion Respuesta',
            'es_opcion_ideal' => 'Es Opcion Ideal',
            'valor_ideal' => 'Valor Ideal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkPregunta()
    {
        return $this->hasOne(Pregunta::className(), ['id_pregunta' => 'fk_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOpcionRespuesta()
    {
        return $this->hasOne(OpcionRespuesta::className(), ['id_opcion_respuesta' => 'fk_opcion_respuesta']);
    }
}
