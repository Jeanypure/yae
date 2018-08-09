<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/9
 * Time: 17:37
 */

namespace backend\modules\yaedata\controllers;

use Yii;
use yii\web\Controller;

class AuditCheckController extends Controller
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