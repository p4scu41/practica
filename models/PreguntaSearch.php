<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pregunta;

/**
 * PreguntaSearch represents the model behind the search form about `app\models\Pregunta`.
 */
class PreguntaSearch extends Pregunta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'fk_tipo_pregunta', 'fk_categoria', 'ponderacion'], 'integer'],
            [['descripcion', 'comentario', 'fecha_creado', 'fecha_modificado'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pregunta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pregunta' => $this->id_pregunta,
            'fk_tipo_pregunta' => $this->fk_tipo_pregunta,
            'fk_categoria' => $this->fk_categoria,
            'ponderacion' => $this->ponderacion,
            'fecha_creado' => $this->fecha_creado,
            'fecha_modificado' => $this->fecha_modificado,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
