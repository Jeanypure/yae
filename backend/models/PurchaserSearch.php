<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Purchaser;

/**
 * PurchaserSearch represents the model behind the search form of `backend\models\Purchaser`.
 */
class PurchaserSearch extends Purchaser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'role'], 'integer'],
            [['has_used', 'grade','purchaser', 'memo', 'code'], 'safe'],
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
    public function search($params,$cat)
    {
        $query = Purchaser::find();

        if($cat == 'grade'){
            $query = Purchaser::find()
                ->andWhere(['has_used'=>1])
                ->andWhere(['in','code',[1,2,3]])
            ;
        }
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
            'role' => $this->role,
            'has_used' => $this->has_used,
            'grade' => $this->grade,
        ]);

        $query->andFilterWhere(['like', 'purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
