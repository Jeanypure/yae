<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/6/1
 * Time: 下午4:25
 */

namespace backend\modules\yaedata\controllers;

use Yii;
use yii\web\Controller;


class ProductStatusController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string+
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionCompute(){

        $res = Yii::$app->db->createCommand("
                                  SELECT 
        count(*) as num,
        master_result,
        case WHEN master_result=0 THEN '拒绝'
         WHEN master_result=1 THEN '采样'
         WHEN master_result=2 THEN '需要议价或谈其他条件'
         WHEN master_result=3 THEN '未评审'
         WHEN master_result=4 THEN '直接下单'	
         WHEN master_result=5 THEN '季节产品'
         ELSE '其他' end as status
         FROM pur_info
        GROUP BY master_result
        ORDER BY num desc
                ")->queryAll();

       $status =  array_column($res,'status');

       foreach($res as $key=>$value){
           $val['value'] = (int)$value['num'];
           $val['name'] = $value['status'];
           $arr[] = $val;


       }
       $result['status'] = $status;
       $result['num'] = $arr;
       echo json_encode($result,true);

    }

    public function actionSample(){
        $firstday = date('Y-m-d', strtotime("-29 day"));
        $lastday = date('Y-m-d');
        $sql = "SELECT 
                o.purchaser,
                count(purchaser) as total
                FROM  sample e
                LEFT JOIN pur_info o ON o.pur_info_id = e.spur_info_id
                WHERE (o.master_result=1 or o.master_result=4)
                  AND  DATE_FORMAT(e.create_date,'%Y-%m-%d') between  '$firstday' and '$lastday'  
                GROUP BY purchaser
                ORDER BY total desc ;";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        $status =  array_column($res,'purchaser');
        foreach($res as $key=>$value){
            $val['value'] = (int)$value['total'];
            $val['name'] = $value['purchaser'];
            $arr[] = $val;
        }
        $result['status'] = $status;
        $result['num'] = $arr;
        echo json_encode($result,true);
    }

    public function actionRecommendSample(){
        $firstday = date('Y-m-d', strtotime("-29 day"));
        $lastday = date('Y-m-d');

        $sql = "
        -- 一段时间内销售推荐产拿样分布 包含直接下单
            SELECT
                t.creator,sum(o.master_result) as  total
            FROM pur_info o
            LEFT JOIN product t ON o.parent_product_id = t.product_id
            WHERE o.source = 0 AND o.is_submit=1 AND (o.master_result=1 OR o.master_result=4) AND product_add_time between '$firstday' and '$lastday'  
            group by creator ORDER BY total DESC;";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        $status =  array_column($res,'creator');
        foreach($res as $key=>$value){
            $val['value'] = (int)$value['total'];
            $val['name'] = $value['creator'];
            $arr[] = $val;
        }
        $result['status'] = $status;
        $result['num'] = $arr;
        echo json_encode($result,true);
    }

    public function actionSurePurchase()
    {
        $firstday = date('Y-m-d', strtotime("-29 day"));
        $lastday = date('Y-m-d');
        $sql = "SELECT 
                o.purchaser,
                count(purchaser) as total
                FROM  pur_info o 
                WHERE o.is_purchase='1' 
                  AND  DATE_FORMAT(o.sure_purchase_time,'%Y-%m-%d') between  '$firstday' and '$lastday'  
                GROUP BY purchaser
                ORDER BY total desc";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        $status =  array_column($res,'purchaser');
        foreach($res as $key=>$value){
            $val['value'] = (int)$value['total'];
            $val['name'] = $value['purchaser'];
            $arr[] = $val;
        }
        $result['status'] = $status;
        $result['num'] = $arr;
        echo json_encode($result,true);
    }
}