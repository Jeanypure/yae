<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form of `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_company_id','product_id'], 'integer'],
            [['accept_status','group_status','complete_status','brocast_status','sub_company','product_title_en', 'product_title', 'ref_url1', 'ref_url2', 'ref_url3', 'ref_url4', 'product_add_time', 'product_update_time','creator'], 'safe'],
            [['product_purchase_value'], 'number'],
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
    public function search($params,$accept_status,$sub_company)
    {
        $this->accept_status = $accept_status;
        $query = Product::find()->orderBy('product_id desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '10',
            ]
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
            'sub_company_id' => $this->sub_company_id,
            'product_purchase_value' => $this->product_purchase_value,
            'product_add_time' => $this->product_add_time,
            'product_update_time' => $this->product_update_time,
        ]);

        $query->andFilterWhere(['like', 'product_title_en', $this->product_title_en])
            ->andFilterWhere(['like', 'product_title', $this->product_title])
            ->andFilterWhere(['like', 'ref_url1', $this->ref_url1])
            ->andFilterWhere(['like', 'ref_url2', $this->ref_url2])
            ->andFilterWhere(['like', 'ref_url3', $this->ref_url3])
            ->andFilterWhere(['like', 'ref_url4', $this->ref_url4])
            ->andFilterWhere(['like', 'brocast_status', $this->brocast_status])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'sub_company', $this->sub_company])
            ->andFilterWhere(['like', 'sub_company', $this->group_status])
            ->andFilterWhere(['like', 'accept_status', $this->accept_status])
            ->andFilterWhere(['like', 'complete_status', $this->complete_status]);

        return $dataProvider;
    }
}
