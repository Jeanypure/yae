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

    public function Search($params)
    {

        $query = PurInfo::find()->alias('po')
            ->select(["po.`pur_info_id`,
                po.`pd_pic_url`,po.`purchaser`,po.`is_purchase`,po.`pd_pur_costprice`,
                e.`has_arrival`,e.`write_date`,
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

            ->orderBy('po.pur_info_id desc')
        ;



        // add conditions that should always apply here
//       echo $query->createCommand()->getRawSql();die;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '10',
            ]
        ]);
        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }




        // grid filtering conditions
        $query->andFilterWhere([
            'pur_info_id' => $this->pur_info_id,

//            'source' => $this->source,
        ]);

        $query->andFilterWhere(['like', 'purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'pd_pic_url', $this->pd_pic_url])


            ->andFilterWhere(['like', 'remark', $this->remark])
        ;

        return $dataProvider;
    }

}