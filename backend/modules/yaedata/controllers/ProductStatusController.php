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
     * @return string
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
         ELSE '其他'end as status
         FROM pur_info
        GROUP BY master_result
                ")->queryAll();
       $status =  array_column($res,'status');

       foreach($res as $key=>$value){
           $val['vaule'] = $value['num'];
           $val['name'] = $value['status'];
           $arr[] = $val;


       }
       $result['status'] = $status;
       $result['data'] = $arr;

       echo json_encode($result,true);

    }
}