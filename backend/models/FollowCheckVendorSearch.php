<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\YaeSupplier;

/**
 * FollowCheckVendorSearch represents the model behind the search form of `backend\models\YaeSupplier`.
 */
class FollowCheckVendorSearch extends YaeSupplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bill_type', 'pay_cycleTime_type', 'account_type', 'has_cooperate', 'licence_pass', 'bill_pass', 'bank_data_pass', 'is_submit_vendor', 'check_status', 'into_eccang_status', 'sale_company'], 'integer'],
            [['supplier_code', 'supplier_name', 'pd_bill_name', 'bill_unit', 'submitter', 'business_licence', 'bank_account_data', 'pay_card', 'pay_name', 'pay_bank', 'sup_remark', 'account_proportion', 'bill_img1', 'bill_img1_name_unit', 'bill_img2', 'bill_img2_name_unit', 'complete_num', 'supplier_address', 'check_memo', 'checker', 'into_eccang_date', 'create_date', 'update_date', 'submit_date', 'check_date'], 'safe'],
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
            'pay_cycleTime_type' => $this->pay_cycleTime_type,
            'account_type' => $this->account_type,
            'has_cooperate' => $this->has_cooperate,
            'licence_pass' => $this->licence_pass,
            'bill_pass' => $this->bill_pass,
            'bank_data_pass' => $this->bank_data_pass,
            'is_submit_vendor' => $this->is_submit_vendor,
            'check_status' => $this->check_status,
            'into_eccang_status' => $this->into_eccang_status,
            'into_eccang_date' => $this->into_eccang_date,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'submit_date' => $this->submit_date,
            'check_date' => $this->check_date,
            'sale_company' => $this->sale_company,
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
            ->andFilterWhere(['like', 'sup_remark', $this->sup_remark])
            ->andFilterWhere(['like', 'account_proportion', $this->account_proportion])
            ->andFilterWhere(['like', 'bill_img1', $this->bill_img1])
            ->andFilterWhere(['like', 'bill_img1_name_unit', $this->bill_img1_name_unit])
            ->andFilterWhere(['like', 'bill_img2', $this->bill_img2])
            ->andFilterWhere(['like', 'bill_img2_name_unit', $this->bill_img2_name_unit])
            ->andFilterWhere(['like', 'complete_num', $this->complete_num])
            ->andFilterWhere(['like', 'supplier_address', $this->supplier_address])
            ->andFilterWhere(['like', 'check_memo', $this->check_memo])
            ->andFilterWhere(['like', 'checker', $this->checker]);

        return $dataProvider;
    }
}
