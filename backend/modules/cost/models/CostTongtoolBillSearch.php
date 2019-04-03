<?php

namespace backend\modules\cost\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cost\models\CostTongtoolBill;

/**
 * CostTongtoolBillSearch represents the model behind the search form of `backend\modules\cost\models\CostTongtoolBill`.
 */
class CostTongtoolBillSearch extends CostTongtoolBill
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bill_no', 'born_date', 'status', 'payment_platform', 'department'], 'safe'],
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
        $query = CostTongtoolBill::find();

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
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'bill_no', $this->bill_no])
            ->andFilterWhere(['like', 'born_date', $this->born_date])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'payment_platform', $this->payment_platform])
            ->andFilterWhere(['like', 'department', $this->department]);

        return $dataProvider;
    }
}
