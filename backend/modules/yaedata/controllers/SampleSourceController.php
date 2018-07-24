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
        $model = new PurInfo();
        return $this->render('index',[
            'model' => $model
        ]);
    }

    public function actionSample(){
        $sql = "SELECT 
                o.purchaser,
                count(purchaser) as total
                FROM  sample e
                LEFT JOIN pur_info o ON o.pur_info_id = e.spur_info_id
                WHERE o.master_result='1' 
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