<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sample;

/**
 * SampleSearch represents the model behind the search form of `backend\models\Sample`.
 */
class SampleSearch extends Sample
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['has_arrival','sample_id', 'spur_info_id', 'is_audit', 'is_agreest', 'is_quality', 'fee_return', 'audit_mem1', 'audit_mem2', 'audit_mem3', 'applicant'], 'integer'],
            [['procurement_cost', 'sample_freight', 'else_fee', 'pay_amount'], 'number'],
            [['arrival_date','write_date','minister_result','minister_reason','pay_way', 'mark', 'create_date', 'lastop_date'], 'safe'],
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
        $query = Sample::find();

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
            'sample_id' => $this->sample_id,
            'spur_info_id' => $this->spur_info_id,
            'procurement_cost' => $this->procurement_cost,
            'sample_freight' => $this->sample_freight,
            'else_fee' => $this->else_fee,
            'pay_amount' => $this->pay_amount,
            'is_audit' => $this->is_audit,
            'is_agreest' => $this->is_agreest,
            'is_quality' => $this->is_quality,
            'fee_return' => $this->fee_return,
            'audit_mem1' => $this->audit_mem1,
            'audit_mem2' => $this->audit_mem2,
            'audit_mem3' => $this->audit_mem3,
            'applicant' => $this->applicant,
            'create_date' => $this->create_date,
            'lastop_date' => $this->lastop_date,
            'has_arrival' => $this->has_arrival,
            'arrival_date' => $this->arrival_date,
            'write_date' => $this->write_date,
            'minister_result' => $this->minister_result,
        ]);

        $query->andFilterWhere(['like', 'pay_way', $this->pay_way])
            ->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'minister_reason', $this->minister_reason]);

        return $dataProvider;
    }
}
