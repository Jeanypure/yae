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

        if(empty($_POST)){
            $firstday = date('Y-m-d', strtotime("-29 day"));
            $lastday = date('Y-m-d');
        }else{
            $arr_date = explode(' - ',$_POST['date_range_2']);
            $firstday = $arr_date[0];
            $lastday = $arr_date[1];
        }
        $sql = "SELECT * FROM (
SELECT  o.purchaser,count(purchaser) as total ,
			'sample' as result_type
			FROM  sample e
			LEFT JOIN pur_info o ON o.pur_info_id = e.spur_info_id
			WHERE o.master_result='1' 
			AND  DATE_FORMAT(e.create_date,'%Y-%m-%d') between '$firstday' and '$lastday'
			GROUP BY purchaser

			UNION 
			SELECT o.purchaser,  count(purchaser) as total,'purchase' as result_type
			FROM  pur_info o 
			WHERE o.is_purchase='1' 
			AND  DATE_FORMAT(o.sure_purchase_time,'%Y-%m-%d') between  '$firstday' and '$lastday'
			GROUP BY purchaser
) aa 
ORDER BY aa.total DESC";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if(!empty($res)){
            $purchase =  array_column($res,'purchaser');
            foreach($res as $key=>$value){
                $val['result_type'] = $value['result_type'];
                if($val['result_type']=='sample'){
                    $val['value'] = (int)$value['total'];
                    $val['name'] = $value['purchaser'];
                    $arr['sample'][] = $val;
                }else{
                    $val['value'] = (int)$value['total'];
                    $val['name'] = $value['purchaser'];
                    $arr['purchase'][] = $val;
                }

            }
            $result['purchase'] = $purchase;
            $result['num'] = $arr;
            return json_encode($result,true);
        }else{
            return json_encode(['success'=>'200OK','msg'=>'所选时间段内没有数据'],true);
        }

    }



}