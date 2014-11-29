<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supervision;

/**
 * SupervisionSearch represents the model behind the search form about `app\models\Supervision`.
 */
class SupervisionSearch extends Supervision
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_supervision', 'fk_usuario'], 'integer'],
            [['fk_clues', 'fecha_supervision'], 'safe'],
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
        $query = Supervision::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fk_usuario' => $this->fk_usuario,
            'fecha_supervision' => $this->fecha_supervision,
        ]);

        $query->andFilterWhere(['like', 'fk_clues', $this->fk_clues]);

        return $dataProvider;
    }
}
