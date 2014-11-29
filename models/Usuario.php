<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $id_usuario
 * @property string $nombre
 * @property string $usuario
 * @property string $password
 * @property string $celular
 * @property string $correo
 * @property string $fecha_creado
 * @property string $fecha_modificado
 *
 * @property Supervision[] $supervisions
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'usuario', 'password'], 'required'],
            [['fecha_creado', 'fecha_modificado'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['usuario'], 'string', 'max' => 12],
            [['password'], 'string', 'max' => 36],
            [['celular'], 'string', 'max' => 15],
            [['correo'], 'string', 'max' => 20],
            [['usuario'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'usuario' => 'Usuario',
            'password' => 'Password',
            'celular' => 'Celular',
            'correo' => 'Correo',
            'fecha_creado' => 'Fecha Creado',
            'fecha_modificado' => 'Fecha Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisions()
    {
        return $this->hasMany(Supervision::className(), ['fk_usuario' => 'id_usuario']);
    }
}
