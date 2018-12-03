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
            [['id', 'quantity','commit_status', 'audit_status'], 'integer'],
            [['requisition_name','tran_internal_id', 'tranid', 'description', 'item_internal_id', 'item_name', 'povendor_internalid', 'povendor_name', 'createdate', 'lastmodifieddate', 'trandate', 'currencyname','negotiant', 'commit_time', 'audit_time'], 'safe'],
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
        $query = RequisitionDetail::find()
            ->select(['`requisition_detail`.*,`requisition_list`.requisition_name'])
            ->joinWith('requisition_list')
            ->orderBy('createdate desc');


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
            ->andFilterWhere(['like', 'requisition_name', $this->requisition_name])
            ->andFilterWhere(['like', 'negotiant', $this->negotiant]);

        return $dataProvider;
    }
}
