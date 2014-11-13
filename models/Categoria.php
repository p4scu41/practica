<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property string $id_categoria
 * @property string $descripcion
 * @property integer $orden
 * @property string $fecha_creado
 * @property string $fecha_modificado
 *
 * @property CategoriaNivel[] $categoriaNivels
 * @property NivelAtencion[] $fkNivelAtencions
 * @property Pregunta[] $preguntas
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['orden'], 'integer'],
            [['fecha_creado', 'fecha_modificado'], 'safe'],
            [['descripcion'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => 'Id Categoria',
            'descripcion' => 'Descripcion',
            'orden' => 'Orden',
            'fecha_creado' => 'Fecha Creado',
            'fecha_modificado' => 'Fecha Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaNivels()
    {
        return $this->hasMany(CategoriaNivel::className(), ['fk_categoria' => 'id_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkNivelAtencions()
    {
        return $this->hasMany(NivelAtencion::className(), ['id_nivel_atencion' => 'fk_nivel_atencion'])->viaTable('categoria_nivel', ['fk_categoria' => 'id_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntas()
    {
        return $this->hasMany(Pregunta::className(), ['fk_categoria' => 'id_categoria']);
    }
}
