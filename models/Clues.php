<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clues".
 *
 * @property string $id_clues
 * @property string $fk_nivel_atencion
 * @property string $nombre
 *
 * @property NivelAtencion $fkNivelAtencion
 * @property Supervision[] $supervisions
 */
class Clues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_clues', 'fk_nivel_atencion'], 'required'],
            [['fk_nivel_atencion'], 'integer'],
            [['id_clues'], 'string', 'max' => 11],
            [['nombre'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_clues' => 'Id Clues',
            'fk_nivel_atencion' => 'Fk Nivel Atencion',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkNivelAtencion()
    {
        return $this->hasOne(NivelAtencion::className(), ['id_nivel_atencion' => 'fk_nivel_atencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisions()
    {
        return $this->hasMany(Supervision::className(), ['fk_clues' => 'id_clues']);
    }
}
