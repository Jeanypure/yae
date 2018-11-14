<?php

namespace backend\modules\bargain\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\bargain\models\RequisitionList;

/**
 * RequisitionListSearch represents the model behind the search form of `backend\modules\bargain\models\RequisitionList`.
 */
class RequisitionListSearch extends RequisitionList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['internal_id', 'requisition_date', 'document_number', 'requisition_name', 'status', 'memo', 'currency', 'get_record_time', 'push_record_time', 'update_record_time'], 'safe'],
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
        $query = RequisitionList::find();

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
            'get_record_time' => $this->get_record_time,
            'push_record_time' => $this->push_record_time,
            'update_record_time' => $this->update_record_time,
        ]);

        $query->andFilterWhere(['like', 'internal_id', $this->internal_id])
            ->andFilterWhere(['like', 'requisition_date', $this->requisition_date])
            ->andFilterWhere(['like', 'document_number', $this->document_number])
            ->andFilterWhere(['like', 'requisition_name', $this->requisition_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
