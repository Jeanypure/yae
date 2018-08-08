<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/7
 * Time: 18:04
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class CommissionSearch extends PurInfo
{
    public function rules()
    {
        return [
            [['source','pur_group','minister_result','is_purchase','has_arrival','source','pur_info_id'], 'integer'],
            [['write_date','purchaser', 'pd_title', 'pd_title_en', 'pd_pic_url',], 'safe'],
            [['grade','weight','unit_price', 'pd_pur_costprice'], 'number'],
        ];
    }
    public function Search($params)
    {
        $username = Yii::$app->user->identity->username;
        $userid = Yii::$app->user->identity->getId();
        $getRolesByUser = Yii::$app->authManager->getRolesByUser($userid);
        $res = Company::find()->select('id,sub_company')
            ->where("leader_id=".$userid)->asArray()->one();
        $sub_id = $res['id']??'';
        $userrole = '';
        foreach ($getRolesByUser as $key=>$val){
            if($key != 'guest'){
             $userrole = $key;
            }
        }
        /*1 推送产品  部长 权重5 采购权重7  不乘等级
        2 部长看自己部门产品
        3 采购自己名下产品
        4 审核组审核所有产品
        */
        if($userrole == '审核组'||$userrole == '超级管理员'){
            $query = PurInfo::find()->alias('po')
                ->select(["po.`pur_info_id`,po.`pur_group`,po.`source`,po.`pd_title`,
                po.`pd_pic_url`,po.`purchaser`,po.`is_purchase`,po.`pd_pur_costprice`,
                e.`has_arrival`,e.`write_date`,e.`minister_result`,
                CASE  WHEN po.`pd_pur_costprice` > 150 THEN 500
                ELSE 400 END AS 'unit_price',    
                CASE WHEN e.`minister_result`=0 THEN 0
                     WHEN e.`minister_result`=1   THEN '5'
                     WHEN e.`minister_result`=2   THEN '10'
                     WHEN e.`minister_result`=3   THEN '5'
                ELSE 0 END AS 'weight',
                pr.`grade` 
                "])
                ->joinWith('sample as e')
                ->leftJoin('purchaser AS pr','pr.purchaser = po.purchaser')
                ->andWhere(['po.is_purchase'=>1])
                ->orderBy('po.pur_info_id desc');
            ;
        }elseif ($userrole == '销售部长'){
            $query = PurInfo::find()->alias('po')
                ->select(["po.`pur_info_id`,po.`pur_group`,po.`source`,po.`pd_title`,
                po.`pd_pic_url`,po.`purchaser`,po.`is_purchase`,po.`pd_pur_costprice`,
                e.`has_arrival`,e.`write_date`,e.`minister_result`,
                CASE  WHEN po.`pd_pur_costprice` > 150 THEN 500
                ELSE 400 END AS 'unit_price',    
                CASE WHEN e.`minister_result`=0 THEN 0
                     WHEN e.`minister_result`=1   THEN '5'
                     WHEN e.`minister_result`=2   THEN '10'
                     WHEN e.`minister_result`=3   THEN '5'
                ELSE 0 END AS 'weight',
                pr.`grade` 
                "])
                ->joinWith('sample as e')
                ->leftJoin('purchaser AS pr','pr.purchaser = po.purchaser')
                ->andWhere(['po.is_purchase'=>1])
                ->orderBy('po.pur_info_id desc');
            $this->pur_group = $sub_id;
        }else{ //采购
            $query = PurInfo::find()->alias('po')
                ->select(["po.`pur_info_id`,po.`pur_group`,po.`source`,po.`pd_title`,
                po.`pd_pic_url`,po.`purchaser`,po.`is_purchase`,po.`pd_pur_costprice`,
                e.`has_arrival`,e.`write_date`,e.`minister_result`,
                CASE  WHEN po.`pd_pur_costprice` > 150 THEN 500
                ELSE 400 END AS 'unit_price',    
                CASE WHEN e.`minister_result`=0 THEN 0
                     WHEN e.`minister_result`=1   THEN '5'
                     WHEN e.`minister_result`=2   THEN '10'
                     WHEN e.`minister_result`=3   THEN '7'
                ELSE 0 END AS 'weight',
                pr.`grade` 
                "])
                ->joinWith('sample as e')
                ->leftJoin('purchaser AS pr','pr.purchaser = po.purchaser')
                ->andWhere(['po.is_purchase'=>1])
                ->orderBy('po.pur_info_id desc');
            $this->purchaser = $username;
        }



        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '20',
            ]
        ]);
        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->write_date)) {
            $query->andFilterCompare('e.write_date', explode('/', $this->write_date)[0], '>=');//起始时间
            $query->andFilterCompare('e.write_date', explode('/', $this->write_date)[1], '<');//结束时间
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'po.pur_info_id' => $this->pur_info_id,
            'po.pur_group' => $this->pur_group,
            'po.is_purchase' => $this->is_purchase,
            'e.minister_result' => $this->minister_result,
            'e.has_arrival' => $this->has_arrival,
            'pr.grade' => $this->grade,
            'weight' => $this->weight,
            'unit_price' => $this->unit_price,
            'source' => $this->source,
        ]);

        $query->andFilterWhere(['like', 'po.purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'po.pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'po.pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'po.pd_pic_url', $this->pd_pic_url])
            ->andFilterWhere(['like', 'po.remark', $this->remark])
        ;


        return $dataProvider;
    }

}