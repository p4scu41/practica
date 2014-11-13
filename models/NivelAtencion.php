<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_atencion".
 *
 * @property string $id_nivel_atencion
 * @property string $descripcion
 * @property string $fecha_creado
 * @property string $fecha_modificado
 *
 * @property CapacitacionNivel[] $capacitacionNivels
 * @property Capacitacion[] $fkCapacitacions
 * @property CategoriaNivel[] $categoriaNivels
 * @property Categoria[] $fkCategorias
 * @property Clues[] $clues
 * @property NivelAtencionPregunta[] $nivelAtencionPreguntas
 * @property Pregunta[] $idPreguntas
 * @property RecursoHumano[] $recursoHumanos
 */
class NivelAtencion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_atencion';
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
            'id_nivel_atencion' => 'Id Nivel Atencion',
            'descripcion' => 'Descripcion',
            'fecha_creado' => 'Fecha Creado',
            'fecha_modificado' => 'Fecha Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapacitacionNivels()
    {
        return $this->hasMany(CapacitacionNivel::className(), ['fk_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCapacitacions()
    {
        return $this->hasMany(Capacitacion::className(), ['id_capacitacion' => 'fk_capacitacion'])->viaTable('capacitacion_nivel', ['fk_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaNivels()
    {
        return $this->hasMany(CategoriaNivel::className(), ['fk_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCategorias()
    {
        return $this->hasMany(Categoria::className(), ['id_categoria' => 'fk_categoria'])->viaTable('categoria_nivel', ['fk_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClues()
    {
        return $this->hasMany(Clues::className(), ['fk_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelAtencionPreguntas()
    {
        return $this->hasMany(NivelAtencionPregunta::className(), ['id_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPreguntas()
    {
        return $this->hasMany(Pregunta::className(), ['id_pregunta' => 'id_pregunta'])->viaTable('nivel_atencion_pregunta', ['id_nivel_atencion' => 'id_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecursoHumanos()
    {
        return $this->hasMany(RecursoHumano::className(), ['fk_nivel_atencion' => 'id_nivel_atencion']);
    }
}
