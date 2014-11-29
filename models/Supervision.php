<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supervision".
 *
 * @property string $id_supervision
 * @property string $fk_usuario
 * @property string $fk_clues
 * @property string $fecha_supervision
 * @property string $observaciones
 * @property string $fecha_creado
 * @property string $fecha_modificado
 *
 * @property RespuestaSupervision[] $respuestaSupervisions
 * @property Clues $fkClues
 * @property Usuario $fkUsuario
 * @property SupervisionRhAtencionObstetrica[] $supervisionRhAtencionObstetricas
 * @property SupervisionRhCapacitado[] $supervisionRhCapacitados
 */
class Supervision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supervision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_usuario', 'fk_clues'], 'required'],
            [['fk_usuario'], 'integer'],
            [['fecha_supervision', 'fecha_creado', 'fecha_modificado'], 'safe'],
            [['observaciones'], 'string'],
            [['fk_clues'], 'string', 'max' => 11],
            [['fecha_supervision'], 'default', 'value' => null],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_supervision' => 'Id Supervision',
            'fk_usuario' => 'Usuario',
            'fk_clues' => 'CLUES',
            'fecha_supervision' => 'Fecha de supervisión',
            'observaciones' => 'Observaciones',
            'fecha_creado' => 'Fecha de creación',
            'fecha_modificado' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaSupervisions()
    {
        return $this->hasMany(RespuestaSupervision::className(), ['fk_supervision' => 'id_supervision']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkClues()
    {
        return $this->hasOne(Clues::className(), ['id_clues' => 'fk_clues']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'fk_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisionRhAtencionObstetricas()
    {
        return $this->hasMany(SupervisionRhAtencionObstetrica::className(), ['fk_supervision' => 'id_supervision']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisionRhCapacitados()
    {
        return $this->hasMany(SupervisionRhCapacitado::className(), ['fk_supervision' => 'id_supervision']);
    }
}
