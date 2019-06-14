<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\YaeFreight;

/**
 * YaeFreightSearch represents the model behind the search form of `backend\models\YaeFreight`.
 */
class YaeFreightSearch extends YaeFreight
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['company_suffix','forwarders','group_name','group_id','builder','minister','contract_no','debit_no','to_minister','to_financial','mini_deal','fina_deal','mini_res','fina_res','bill_to', 'receiver', 'shipment_id', 'pod', 'pol', 'etd', 'eta', 'remark'], 'safe'],
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
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if(array_key_exists('超级管理员',$role)||array_key_exists('审核组',$role)){
            $query = YaeFreight::find()
                ->select(['`yae_freight`.*,`yae_group`.group_name,`freight_forwarders`.forwarders ,`company`.company_suffix'])
                ->joinWith('yaegroup')
                ->joinWith('freightforwarders')
                ->joinWith('company')
                ->orderBy('id desc')
            ;

        }else{
            $query = YaeFreight::find()
                ->andWhere(['builder'=>$username])
                ->orderBy('id desc')
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
            'to_minister' => $this->to_minister,
            'to_financial' => $this->to_financial,
            'mini_deal' => $this->mini_deal,
            'fina_deal' => $this->fina_deal,
            'etd' => $this->etd,
            'eta' => $this->eta,
            'group_id' => $this->group_id

        ]);

        $query->andFilterWhere(['like', 'bill_to', $this->bill_to])
            ->andFilterWhere(['like', 'receiver', $this->receiver])
            ->andFilterWhere(['like', 'shipment_id', $this->shipment_id])
            ->andFilterWhere(['like', 'pod', $this->pod])
            ->andFilterWhere(['like', 'pol', $this->pol])
            ->andFilterWhere(['like', 'contract_no', $this->contract_no])
            ->andFilterWhere(['like', 'debit_no', $this->debit_no])
            ->andFilterWhere(['like', 'minister', $this->minister])
            ->andFilterWhere(['like', 'builder', $this->builder])
            ->andFilterWhere(['like', 'group_name', $this->group_name])
            ->andFilterWhere(['like', 'forwarders', $this->forwarders])
            ->andFilterWhere(['like', 'company_suffix', $this->company_suffix])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
