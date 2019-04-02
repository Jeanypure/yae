<?php

namespace backend\modules\cost\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cost\models\DomesticFreight;

/**
 * DomesticFreightSearch represents the model behind the search form of `backend\modules\cost\models\DomesticFreight`.
 */
class DomesticFreightSearch extends DomesticFreight
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dfid','has_checked'], 'integer'],
            [['purchase_no', 'sku', 'creator', 'applicant', 'subsidiaries', 'group', 'create_date', 'application_date'], 'safe'],
            [['freight'], 'number'],
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
        $query = DomesticFreight::find();

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
            'dfid' => $this->dfid,
            'freight' => $this->freight,
            'create_date' => $this->create_date,
            'application_date' => $this->application_date,
            'has_checked'=> $this->has_checked
        ]);

        $query->andFilterWhere(['like', 'purchase_no', $this->purchase_no])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'applicant', $this->applicant])
            ->andFilterWhere(['like', 'subsidiaries', $this->subsidiaries])
            ->andFilterWhere(['like', 'group', $this->group]);

        return $dataProvider;
    }
}
