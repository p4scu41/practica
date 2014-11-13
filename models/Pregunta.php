<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property string $id_pregunta
 * @property string $fk_tipo_pregunta
 * @property string $fk_categoria
 * @property string $descripcion
 * @property string $comentario
 * @property integer $ponderacion
 * @property string $fecha_creado
 * @property string $fecha_modificado
 *
 * @property NivelAtencionPregunta[] $nivelAtencionPreguntas
 * @property NivelAtencion[] $idNivelAtencions
 * @property OpcionPregunta[] $opcionPreguntas
 * @property OpcionRespuesta[] $fkOpcionRespuestas
 * @property Categoria $fkCategoria
 * @property TipoPregunta $fkTipoPregunta
 * @property RespuestaSupervision[] $respuestaSupervisions
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_tipo_pregunta', 'fk_categoria', 'descripcion'], 'required'],
            [['fk_tipo_pregunta', 'fk_categoria', 'ponderacion'], 'integer'],
            [['fecha_creado', 'fecha_modificado'], 'safe'],
            [['descripcion'], 'string', 'max' => 60],
            [['comentario'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pregunta' => 'Id Pregunta',
            'fk_tipo_pregunta' => 'Tipo',
            'fk_categoria' => 'Categoría',
            'descripcion' => 'Descripción',
            'comentario' => 'Comentario',
            'ponderacion' => 'Ponderación',
            'fecha_creado' => 'Fecha de creación',
            'fecha_modificado' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelAtencionPreguntas()
    {
        return $this->hasMany(NivelAtencionPregunta::className(), ['id_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNivelAtencions()
    {
        return $this->hasMany(NivelAtencion::className(), ['id_nivel_atencion' => 'id_nivel_atencion'])->viaTable('nivel_atencion_pregunta', ['id_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpcionPreguntas()
    {
        return $this->hasMany(OpcionPregunta::className(), ['fk_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOpcionRespuestas()
    {
        return $this->hasMany(OpcionRespuesta::className(), ['id_opcion_respuesta' => 'fk_opcion_respuesta'])->viaTable('opcion_pregunta', ['fk_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'fk_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTipoPregunta()
    {
        return $this->hasOne(TipoPregunta::className(), ['id_tipo_pregunta' => 'fk_tipo_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaSupervisions()
    {
        return $this->hasMany(RespuestaSupervision::className(), ['fk_pregunta' => 'id_pregunta']);
    }
}
