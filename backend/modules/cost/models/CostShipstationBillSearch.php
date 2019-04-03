<?php

namespace backend\modules\cost\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cost\models\CostShipstationBill;

/**
 * CostShipstationBillSearch represents the model behind the search form of `backend\modules\cost\models\CostShipstationBill`.
 */
class CostShipstationBillSearch extends CostShipstationBill
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'invoice', 'department'], 'safe'],
            [['subtotal', 'exchange_rate', 'amount'], 'number'],
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
        $query = CostShipstationBill::find();

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
            'date' => $this->date,
            'subtotal' => $this->subtotal,
            'exchange_rate' => $this->exchange_rate,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'invoice', $this->invoice])
            ->andFilterWhere(['like', 'department', $this->department]);

        return $dataProvider;
    }
}
