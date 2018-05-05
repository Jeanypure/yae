<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Goods;

/**
 * GoodsSearch represents the model behind the search form of `backend\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['id'], 'integer'],
            [['goodsname_cn', 'goodsname_en', 'link1', 'link2', 'link3'], 'safe'],
            [['retail'], 'number'],
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
        $query = Goods::find();

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
            'retail' => $this->retail,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'goodsname_cn', $this->goodsname_cn])
            ->andFilterWhere(['like', 'goodsname_en', $this->goodsname_en])
            ->andFilterWhere(['like', 'link1', $this->link1])
            ->andFilterWhere(['like', 'link2', $this->link2])
            ->andFilterWhere(['like', 'link3', $this->link3]);

        return $dataProvider;
    }
}
