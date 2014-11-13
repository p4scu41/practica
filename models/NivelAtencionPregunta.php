<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_atencion_pregunta".
 *
 * @property string $id_nivel_atencion
 * @property string $id_pregunta
 *
 * @property NivelAtencion $idNivelAtencion
 * @property Pregunta $idPregunta
 */
class NivelAtencionPregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_atencion_pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nivel_atencion', 'id_pregunta'], 'required'],
            [['id_nivel_atencion', 'id_pregunta'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_nivel_atencion' => 'Id Nivel Atencion',
            'id_pregunta' => 'Id Pregunta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNivelAtencion()
    {
        return $this->hasOne(NivelAtencion::className(), ['id_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPregunta()
    {
        return $this->hasOne(Pregunta::className(), ['id_pregunta' => 'id_pregunta']);
    }
}
