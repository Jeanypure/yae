<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ReviewSearch represents the model behind the search form of `backend\models\Product`.
 */
class ReviewSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['product_title_en', 'product_title', 'ref_url1', 'ref_url2', 'ref_url3', 'ref_url4', 'product_add_time', 'product_update_time', 'purchaser', 'creator', 'product_status', 'pd_pic_url', 'preview_time', 'preview_mark', 'sub_company', 'group_mark', 'group_time', 'group_update_time', 'group_status', 'brocast_status'], 'safe'],
            [['product_purchase_value'], 'number'],
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
        $query = Product::find();

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
            'product_id' => $this->product_id,
            'product_purchase_value' => $this->product_purchase_value,
            'product_add_time' => $this->product_add_time,
            'product_update_time' => $this->product_update_time,
            'preview_time' => $this->preview_time,
            'sub_company' => $this->sub_company,
            'group_time' => $this->group_time,
            'group_update_time' => $this->group_update_time,
        ]);

        $query->andFilterWhere(['like', 'product_title_en', $this->product_title_en])
            ->andFilterWhere(['like', 'product_title', $this->product_title])
            ->andFilterWhere(['like', 'ref_url1', $this->ref_url1])
            ->andFilterWhere(['like', 'ref_url2', $this->ref_url2])
            ->andFilterWhere(['like', 'ref_url3', $this->ref_url3])
            ->andFilterWhere(['like', 'ref_url4', $this->ref_url4])
            ->andFilterWhere(['like', 'purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'product_status', $this->product_status])
            ->andFilterWhere(['like', 'pd_pic_url', $this->pd_pic_url])
            ->andFilterWhere(['like', 'preview_mark', $this->preview_mark])
            ->andFilterWhere(['like', 'group_mark', $this->group_mark])
            ->andFilterWhere(['like', 'group_status', $this->group_status])
            ->andFilterWhere(['like', 'brocast_status', $this->brocast_status])

        ;

        return $dataProvider;
    }
}
