<?php

namespace backend\modules\bargain\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\bargain\models\RequisitionDetail;

/**
 * RequisitionDetailSearch represents the model behind the search form of `backend\modules\bargain\models\RequisitionDetail`.
 */
class RequisitionDetailSearch extends RequisitionDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'payment_method', 'commit_status', 'audit_status'], 'integer'],
            [['tran_internal_id', 'tranid', 'description', 'item_internal_id', 'item_name', 'povendor_internalid', 'povendor_name', 'createdate', 'lastmodifieddate', 'trandate', 'currencyname', 'supplier_name', 'contact_name', 'contact_tel', 'contact_qq', 'bill_type', 'arrival_date', 'negotiant', 'commit_time', 'audit_time'], 'safe'],
            [['amount', 'rate'], 'number'],
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
        $query = RequisitionDetail::find()->orderBy('id desc');

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
            'quantity' => $this->quantity,
            'rate' => $this->rate,
            'payment_method' => $this->payment_method,
            'commit_time' => $this->commit_time,
            'commit_status' => $this->commit_status,
            'audit_time' => $this->audit_time,
            'audit_status' => $this->audit_status,
        ]);

        $query->andFilterWhere(['like', 'tran_internal_id', $this->tran_internal_id])
            ->andFilterWhere(['like', 'tranid', $this->tranid])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'item_internal_id', $this->item_internal_id])
            ->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'povendor_internalid', $this->povendor_internalid])
            ->andFilterWhere(['like', 'povendor_name', $this->povendor_name])
            ->andFilterWhere(['like', 'createdate', $this->createdate])
            ->andFilterWhere(['like', 'lastmodifieddate', $this->lastmodifieddate])
            ->andFilterWhere(['like', 'trandate', $this->trandate])
            ->andFilterWhere(['like', 'currencyname', $this->currencyname])
            ->andFilterWhere(['like', 'supplier_name', $this->supplier_name])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_tel', $this->contact_tel])
            ->andFilterWhere(['like', 'contact_qq', $this->contact_qq])
            ->andFilterWhere(['like', 'bill_type', $this->bill_type])
            ->andFilterWhere(['like', 'arrival_date', $this->arrival_date])
            ->andFilterWhere(['like', 'negotiant', $this->negotiant]);

        return $dataProvider;
    }
}
