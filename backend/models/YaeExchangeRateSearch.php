<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\YaeExchangeRate;

/**
 * YaeExchangeRateSearch represents the model behind the search form of `backend\models\YaeExchangeRate`.
 */
class YaeExchangeRateSearch extends YaeExchangeRate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['exchange_rate'], 'number'],
            [['memo', 'currency'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = YaeExchangeRate::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'exchange_rate' => $this->exchange_rate,
        ]);

        $query->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
