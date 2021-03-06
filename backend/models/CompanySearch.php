<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Company;

/**
 * CompanySearch represents the model behind the search form of `backend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['has_site','no_site','sub_company', 'department', 'leader', 'memo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Company::find();

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
        ]);

        $query->andFilterWhere(['like', 'sub_company', $this->sub_company])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'leader', $this->leader])
            ->andFilterWhere(['like', 'has_site', $this->has_site])
            ->andFilterWhere(['like', 'no_site', $this->no_site])
            ->andFilterWhere(['like', 'leader', $this->leader])
            ->andFilterWhere(['like', 'memo', $this->memo]);

        return $dataProvider;
    }
}
