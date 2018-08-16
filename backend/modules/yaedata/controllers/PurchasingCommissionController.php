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
use backend\models\PurInfo;
use backend\models\Sample;

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

    public function  actionAuditCheck(){

        $searchModel = new CommissionSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('audit-check', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdjust($id){

        $sample_model = Sample::findOne(['spur_info_id'=>$id]);
        $info = PurInfo::findOne(['pur_info_id'=>$id]);
        if($sample_model->load(Yii::$app->request->post()) ){
            $sample_model->save();
            return $this->redirect(['audit-check']);

        }
        return  $this->renderAjax('adjust', [
            'model' => $sample_model,
            'info' => $info,
        ]);
    }


}