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

class PurchasingCommissionController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}