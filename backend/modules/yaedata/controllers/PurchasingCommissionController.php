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
use backend\models\CommissionSearch;

class PurchasingCommissionController extends Controller
{

    public function actionIndex()
    {

        $searchModel = new CommissionSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }



}