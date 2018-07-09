<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\YaeSupplier;

/**
 * YaeSupplierSearch represents the model behind the search form of `backend\models\YaeSupplier`.
 */
class YaeSupplierSearch extends YaeSupplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bill_type'], 'integer'],
            [['supplier_code', 'supplier_name', 'pd_bill_name', 'bill_unit', 'submitter', 'business_licence', 'bank_account_data', 'pay_card', 'pay_name', 'pay_bank', 'sup_remark'], 'safe'],
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
        $query = YaeSupplier::find();

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
            'bill_type' => $this->bill_type,
        ]);

        $query->andFilterWhere(['like', 'supplier_code', $this->supplier_code])
            ->andFilterWhere(['like', 'supplier_name', $this->supplier_name])
            ->andFilterWhere(['like', 'pd_bill_name', $this->pd_bill_name])
            ->andFilterWhere(['like', 'bill_unit', $this->bill_unit])
            ->andFilterWhere(['like', 'submitter', $this->submitter])
            ->andFilterWhere(['like', 'business_licence', $this->business_licence])
            ->andFilterWhere(['like', 'bank_account_data', $this->bank_account_data])
            ->andFilterWhere(['like', 'pay_card', $this->pay_card])
            ->andFilterWhere(['like', 'pay_name', $this->pay_name])
            ->andFilterWhere(['like', 'pay_bank', $this->pay_bank])
            ->andFilterWhere(['like', 'sup_remark', $this->sup_remark]);

        return $dataProvider;
    }
}
