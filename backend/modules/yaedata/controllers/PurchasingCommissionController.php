<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/7
 * Time: 13:18
 */

namespace backend\modules\yaedata\controllers;
use Yii;
use yii\web\Controller;
use yii\data\SqlDataProvider;
use backend\models\PurInfo;
use backend\models\CommissionSearch;
use yii\data\ActiveDataProvider;

class PurchasingCommissionController extends Controller
{
    public function actionIndex()
    {

        $sql = "
            SELECT o.pur_info_id,o.pd_pic_url,o.purchaser,o.is_purchase,o.pd_pur_costprice,e.has_arrival,e.write_date,e.minister_result,e.arrival_date,
            CASE  WHEN pd_pur_costprice > 150 THEN 500
            ELSE 400 END AS 'unit_price',    -- 跟单提成 如果单价大于150 就是500 否则400 
            CASE WHEN minister_result=0 THEN 0
                 WHEN minister_result=1   THEN 0.5
                 WHEN minister_result=2   THEN 1
                 WHEN minister_result=3   THEN 0.5
            ELSE 0 END AS 'weight',  -- 权重 
            r.grade
            FROM pur_info  o 
            LEFT JOIN sample e ON e.spur_info_id=o.pur_info_id
            LEFT JOIN purchaser r ON r.purchaser=o.purchaser
            WHERE o.is_purchase=1 ;

        ";

        $count = Yii::$app->db->createCommand('
           select count(*) from pur_info where  is_purchase=1
         ')->queryScalar();
//        $result = Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump($count);die;
        $provider = new SqlDataProvider([
            'sql' => "$sql",
            'key' => 'pur_info_id',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'pur_info_id',
//                    'view_count',
//                    'created_at',
                ],
            ],
        ]);
        // 返回包含每一行的数组
//        $models = $provider->getModels();
//        data-key
        return $this->render('index',[
                'dataProvider'=>$provider,
            ]
            );
    }

    public function actionTest()
    {

        $searchModel = new CommissionSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('test', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

       /* return $this->render('test',[
                'dataProvider'=>$provider,
            ]);*/
    }



}