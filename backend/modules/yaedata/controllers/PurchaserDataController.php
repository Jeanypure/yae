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
}