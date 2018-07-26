<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NewContract;

/**
 * NewContractSearch represents the model behind the search form of `backend\models\NewContract`.
 */
class NewContractSearch extends NewContract
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity'], 'integer'],
            [['buy_company', 'declare_no1', 'project_no', 'factory', 'purchase_contract_no', 'product_name', 'unit', 'declare_no', 'purchaser', 'sku'], 'safe'],
            [['amount'], 'number'],
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
        $query = NewContract::find();

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
            'quantity' => $this->quantity,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'buy_company', $this->buy_company])
            ->andFilterWhere(['like', 'declare_no1', $this->declare_no1])
            ->andFilterWhere(['like', 'project_no', $this->project_no])
            ->andFilterWhere(['like', 'factory', $this->factory])
            ->andFilterWhere(['like', 'purchase_contract_no', $this->purchase_contract_no])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'declare_no', $this->declare_no])
            ->andFilterWhere(['like', 'purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'sku', $this->sku]);

        return $dataProvider;
    }
}
