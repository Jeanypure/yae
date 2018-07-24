<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/7/24
 * Time: 9:33
 */

namespace backend\modules\yaedata\controllers;
use backend\models\PurInfo;
use Yii;
use yii\web\Controller;


class SampleSourceController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionSample(){

        $firstday = date('Y-m-d', strtotime("-30 day"));
        $lastday = date('Y-m-d', strtotime("-1 day"));

        $sql = "SELECT  o.purchaser,count(purchaser) as total
                FROM  sample e
                LEFT JOIN pur_info o ON o.pur_info_id = e.spur_info_id
                WHERE o.master_result='1' 
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


}