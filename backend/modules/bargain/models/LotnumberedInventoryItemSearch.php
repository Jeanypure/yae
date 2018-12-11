<?php

namespace backend\modules\bargain\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\bargain\models\LotnumberedInventoryItem;

/**
 * LotnumberedInventoryItemSearch represents the model behind the search form of `backend\modules\bargain\models\LotnumberedInventoryItem`.
 */
class LotnumberedInventoryItemSearch extends LotnumberedInventoryItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['internalid', 'sku', 'property', 'bargain'], 'safe'],
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
        $query = LotnumberedInventoryItem::find();

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

        $query->andFilterWhere(['like', 'internalid', $this->internalid])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'property', $this->property])
            ->andFilterWhere(['like', 'bargain', $this->bargain]);

        return $dataProvider;
    }
}
