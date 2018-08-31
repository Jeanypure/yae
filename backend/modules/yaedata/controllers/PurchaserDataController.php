<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/6/1
 * Time: 下午4:25
 */

namespace backend\modules\yaedata\controllers;

use backend\models\Purchaser;
use Yii;
use yii\web\Controller;
use yii\data\SqlDataProvider;


class PurchaserDataController extends Controller
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
            purchaser,
            count(*) as pd_num,
            DATE_FORMAT(pd_create_time,'%Y-%m-%d') as preday 
            FROM `pur_info`
            GROUP BY purchaser,DATE_FORMAT(pd_create_time,'%Y-%m-%d');
        ")->queryAll();
        $purchasers = array_unique(array_column($res,'purchaser')) ;
        $perday = array_unique(array_column($res,'preday')) ;

        var_dump($purchasers);
        var_dump($perday);
        die;

    }

    public function actionMasterResult(){
        $sql = "
            -- 产品拒绝率 采样率 采购率统计
          SELECT 
            purchaser,
            SUM(CASE WHEN master_result=0 THEN number ELSE 0 END) AS 'reject', 
            SUM(CASE WHEN master_result=1 THEN number ELSE 0 END) AS 'get', 
            SUM(CASE WHEN master_result=2 THEN number ELSE 0 END) AS 'need',
            SUM(CASE WHEN master_result=3 THEN number ELSE 0 END) AS 'undo',
            SUM(CASE WHEN master_result=4 THEN number ELSE 0 END) AS 'direct',
            SUM(CASE WHEN master_result=5 THEN number ELSE 0 END) AS 'season'
            
            FROM ( SELECT
            purchaser,
            master_result,
            count(*) AS number
            FROM
            pur_info
            WHERE   
            is_submit = 1
            GROUP BY
            master_result,purchaser
            ) bb
            GROUP BY purchaser
        ";


        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
        ]);

        // get the user records in the current page
//        $model = $dataProvider->getModels();

        return $this->render('result',[
            'dataProvider' => $dataProvider,
        ]);


    }
}