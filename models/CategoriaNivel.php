<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria_nivel".
 *
 * @property string $fk_categoria
 * @property string $fk_nivel_atencion
 * @property integer $ponderacion
 *
 * @property Categoria $fkCategoria
 * @property NivelAtencion $fkNivelAtencion
 */
class CategoriaNivel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria_nivel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_categoria', 'fk_nivel_atencion'], 'required'],
            [['fk_categoria', 'fk_nivel_atencion', 'ponderacion'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fk_categoria' => 'Fk Categoria',
            'fk_nivel_atencion' => 'Fk Nivel Atencion',
            'ponderacion' => 'Ponderacion',
        ];
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
    public function getFkNivelAtencion()
    {
        return $this->hasOne(NivelAtencion::className(), ['id_nivel_atencion' => 'fk_nivel_atencion']);
    }
}
