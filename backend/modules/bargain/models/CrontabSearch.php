<?php

namespace backend\modules\bargain\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\bargain\models\Crontab;

/**
 * CrontabSearch represents the model behind the search form of `backend\modules\bargain\models\Crontab`.
 */
class CrontabSearch extends Crontab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'switch', 'status'], 'integer'],
            [['name', 'route', 'crontab_str', 'last_rundate', 'next_rundate'], 'safe'],
            [['execmemory', 'exectime'], 'number'],
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
        $query = Crontab::find();

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
            'switch' => $this->switch,
            'status' => $this->status,
            'last_rundate' => $this->last_rundate,
            'next_rundate' => $this->next_rundate,
            'execmemory' => $this->execmemory,
            'exectime' => $this->exectime,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'crontab_str', $this->crontab_str]);

        return $dataProvider;
    }
}
