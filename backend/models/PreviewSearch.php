<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Preview;

/**
 * PreviewSearch represents the model behind the search form of `backend\models\Preview`.
 */
class PreviewSearch extends Preview
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['preview_id', 'product_id', 'member_id'], 'integer'],
            [['member', 'content', 'result', 'priview_time'], 'safe'],
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
        $query = Preview::find();

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
            'preview_id' => $this->preview_id,
            'product_id' => $this->product_id,
            'priview_time' => $this->priview_time,
            'member_id' => $this->member_id,
        ]);

        $query->andFilterWhere(['like', 'member', $this->member])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'result', $this->result]);

        return $dataProvider;
    }
}
