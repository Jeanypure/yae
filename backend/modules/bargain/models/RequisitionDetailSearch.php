<?php

namespace backend\modules\bargain\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
            [['name','bargain','tran_internal_id', 'tranid', 'description', 'item_internal_id', 'item_name', 'povendor_internalid', 'povendor_name', 'createdate', 'lastmodifieddate', 'trandate', 'currencyname','negotiant', 'commit_time', 'audit_time'], 'safe'],
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
        $username = Yii::$app->user->identity->username;
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if(array_key_exists('超级管理员',$role)||array_key_exists('审核组',$role)){
            $query = RequisitionDetail::find()
                ->alias('l')
                ->select(['`l`.id,`l`.tran_internal_id,`l`.tranid,`l`.item_name,`l`.povendor_internalid,
                `l`.povendor_name,`l`.quantity,`l`.description,`l`.createdate,`l`.audit_status,`l`.commit_status,
                `np`.name,`m`.bargain'])
                ->joinwith('tb_requisition_non_purchase as np')
                ->joinwith('tb_lotnumbered_inventory_item as m')
                ->where(['not',['np.tranid' =>null]])
//                ->where(['commit_status' => 1])
                ->orderby('l.createdate desc');
        }else{
            $query = RequisitionDetail::find()
                ->alias('l')
                ->select(['`l`.id,`l`.tran_internal_id,`l`.tranid,`l`.item_name,`l`.povendor_internalid,
                `l`.povendor_name,`l`.quantity,`l`.description,`l`.createdate,`l`.audit_status,`l`.commit_status,
                `np`.name,`m`.bargain'])
                ->joinwith('tb_requisition_non_purchase as np')
                ->joinwith('tb_lotnumbered_inventory_item as m')
                ->where(['not',['np.tranid' =>null]])
                ->andWhere(['`m`.bargain'=>$username])
                ->orderby('l.createdate desc');

        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->commit_status = 0;
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andfilterwhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'quantity' => $this->quantity,
            'rate' => $this->rate,
            'commit_time' => $this->commit_time,
            'commit_status' => $this->commit_status,
            'audit_time' => $this->audit_time,
            'audit_status' => $this->audit_status,
        ]);

        $query->andfilterwhere(['like', 'tran_internal_id', $this->tran_internal_id])
            ->andfilterwhere(['like', 'tranid', $this->tranid])
            ->andfilterwhere(['like', 'description', $this->description])
            ->andfilterwhere(['like', 'item_internal_id', $this->item_internal_id])
            ->andfilterwhere(['like', 'item_name', $this->item_name])
            ->andfilterwhere(['like', 'povendor_internalid', $this->povendor_internalid])
            ->andfilterwhere(['like', 'povendor_name', $this->povendor_name])
            ->andfilterwhere(['like', 'createdate', $this->createdate])
            ->andfilterwhere(['like', 'lastmodifieddate', $this->lastmodifieddate])
            ->andfilterwhere(['like', 'trandate', $this->trandate])
            ->andfilterwhere(['like', 'currencyname', $this->currencyname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bargain', $this->bargain])
            ->andFilterWhere(['like', 'negotiant', $this->negotiant]);

        return $dataProvider;
    }
}
