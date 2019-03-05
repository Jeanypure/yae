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
		SELECT r.purchaser,IFNULL(t1.total,0) as total,'sample' as result_type   from purchaser r LEFT JOIN ( 
      SELECT  o.purchaser,count(purchaser) as total ,
			'sample' as result_type
			FROM  sample e
			LEFT JOIN pur_info o ON o.pur_info_id = e.spur_info_id
			WHERE (o.master_result=1 or o.master_result=4)
			AND  DATE_FORMAT(e.create_date,'%Y-%m-%d') between '$firstday' and '$lastday'
			GROUP BY purchaser
) t1   ON t1.purchaser = r.purchaser where sku_code1 is NOT NULL AND sku_code1<> '' AND has_used=1
			UNION
SELECT r.purchaser,IFNULL(t1.total,0) as total ,'purchase' as result_type from purchaser r LEFT JOIN (  
			SELECT o.purchaser,  count(purchaser) as total,'purchase' as result_type
			FROM  pur_info o 
			WHERE o.is_purchase='1' 
			AND  DATE_FORMAT(o.sure_purchase_time,'%Y-%m-%d') between  '$firstday' and '$lastday'
			GROUP BY purchaser
) t1   ON t1.purchaser = r.purchaser where sku_code1 is NOT NULL AND sku_code1<> '' AND has_used=1
			UNION
			SELECT pur_group AS purchaser , count(pur_group) as total,'group' as result_type
			FROM  pur_info o 
			WHERE o.is_purchase='1' 
			AND  DATE_FORMAT(o.sure_purchase_time,'%Y-%m-%d') between  '$firstday' and '$lastday'
			GROUP BY pur_group
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
                }elseif ($val['result_type']=='purchase'){
                    $val['value'] = (int)$value['total'];
                    $val['name'] = $value['purchaser'];
                    $arr['purchase'][] = $val;
                }elseif ($val['result_type']=='group'){
                    $val['value'] = (int)$value['total'];
                    $val['name'] = $value['purchaser'].'部';
                    $arr['group'][] = $val;
                }

            }
            $result['purchase']['purchase'] = $purchase;
            $result['num'] = $arr;
            $result['purchase']['group'] = ['1部','2部','3部','4部','5部','6部','7部','8部'];
            return json_encode($result,true);
        }else{
            return json_encode(['success'=>'200OK','msg'=>'所选时间段内没有数据'],true);
        }

    }



}