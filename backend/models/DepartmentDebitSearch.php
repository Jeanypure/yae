<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\YaeFreight;

/**
 * DepartmentDebitSearch represents the model behind the search form of `backend\models\YaeFreight`.
 */
class DepartmentDebitSearch extends YaeFreight
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'to_minister', 'to_financial', 'mini_deal', 'fina_deal'], 'integer'],
            [['contract_no','debit_no','bill_to', 'receiver', 'shipment_id', 'pod', 'pol', 'etd', 'eta', 'remark', 'image', 'mini_res', 'fina_res'], 'safe'],
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
        $username = Yii::$app->user->identity->username;

        if($username=='Jenny'||$username=='David'||$username=='Mark'||$username=='Winnie') {
            $query = YaeFreight::find()->where(['to_minister'=> 1]);

        }else{
            $query = YaeFreight::find()
                ->where(['to_minister'=> 1])
                ->andWhere(['minister'=>$username])
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
            'etd' => $this->etd,
            'eta' => $this->eta,
            'to_minister' => $this->to_minister,
            'to_financial' => $this->to_financial,
            'mini_deal' => $this->mini_deal,
            'fina_deal' => $this->fina_deal,
        ]);

        $query->andFilterWhere(['like', 'bill_to', $this->bill_to])
            ->andFilterWhere(['like', 'receiver', $this->receiver])
            ->andFilterWhere(['like', 'shipment_id', $this->shipment_id])
            ->andFilterWhere(['like', 'pod', $this->pod])
            ->andFilterWhere(['like', 'pol', $this->pol])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'mini_res', $this->mini_res])
            ->andFilterWhere(['like', 'fina_res', $this->fina_res]);

        return $dataProvider;
    }
}