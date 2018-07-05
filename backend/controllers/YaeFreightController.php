<?php

namespace backend\controllers;

use Yii;
use backend\models\YaeFreight;
use backend\models\FreightFee;
use backend\models\FeeCategory;
use backend\models\YaeExchangeRate;
use backend\models\YaeFreightSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

use yii\helpers\Json;

use common\components\Upload;
use yii\web\Response;

/**
 * YaeFreightController implements the CRUD actions for YaeFreight model.
 */
class YaeFreightController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all YaeFreight models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YaeFreightSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single YaeFreight model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new YaeFreight model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new YaeFreight();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->actionFee($model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing YaeFreight model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        $host = 'yaemart.com.cn';
        $model = $this->findModel($id);
        $fee_model = FreightFee::find()->where(['freight_id'=>$id])->all();
//        $result  = FeeCategory::find()->orderBy('id')->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
//             $model->image = $host.Yii::$app->request->post()['YaeFreight']['image'];
             $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $query = FreightFee::find()->indexBy('id')->where(['freight_id'=>$id]); // where `id` is your primary key
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->render('update', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'fee_model' => $fee_model,
        ]);
    }

    /**
     * Deletes an existing YaeFreight model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the YaeFreight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return YaeFreight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = YaeFreight::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function  actionFee($freight_id){
           $fee_to = Yii::$app->db->createCommand("
            CALL freight_to_fee ($freight_id)
            ")->execute();
           if($fee_to){
               return 'OK!';
           }
           return 'error!';


    }

    public function  actionCreateFee($id){

        $model = new FreightFee();
        $param  = $this->actionParam();
        if(isset($id)&&!empty($id)){
            $model -> freight_id = $id;
            $model->save();
        }


        if ($model->load(Yii::$app->request->post()) ) {

           $quantity = Yii::$app->request->post()['FreightFee']['quantity'];
           $unit_price = Yii::$app->request->post()['FreightFee']['unit_price'];
           $model->amount = intval($quantity) * floatval($unit_price);
           if($model->save()){
               return $this->redirect(['update', 'id' =>$id]);

           }
        }

        return $this->renderAjax('create_fee', [
            'model' => $model,
            'fee_category' => $param['name_zn'],
            'currency' => $param['currency'],
        ]);

    }

    public function  actionUpdateFee($id){

        $model = FreightFee::find()->where(['id'=>$id])->one();
        $param  = $this->actionParam();
        if ($model->load(Yii::$app->request->post()) ) {
            $quantity = Yii::$app->request->post()['FreightFee']['quantity'];
            $unit_price = Yii::$app->request->post()['FreightFee']['unit_price'];
            $model->amount = intval($quantity) * floatval($unit_price);
            if($model->save()){
                return $this->redirect(['update','id' =>$model->freight_id ]);
            }

        }

        return $this->renderAjax('update_fee', [
            'model' => $model,
            'fee_category' => $param['name_zn'],
            'currency' => $param['currency'],
        ]);
    }

    public function  actionParam(){

        $fee_cate =  FeeCategory::find()->select('id,name_zn')->asArray()->All();
        $cur =  YaeExchangeRate::find()->select('id,currency')->asArray()->All();
        $arr =[];
        $currency =[];
        foreach($fee_cate as $key=>$value){
            $arr[$value['id']] = $value['name_zn'];
        }
        foreach($cur as $key=>$value){
            $currency[$value['id']] = $value['currency'];
        }

        $param['name_zn'] = $arr;
        $param['currency'] = $currency;
        return $param;
    }

    public  function  actionFeeDelete($id){

        $feecat = FreightFee::find()->where(['id'=>$id])->one();
        if($feecat->delete()) {
            echo 1;
            Yii::$app->end();
        }
        echo 0;
        Yii::$app->end();

    }


    //webUploader上传
    public function actionUpload()
    {
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new Upload();
            $info = $model->upImage();
            if ($info && is_array($info)) {
                return $info;
            } else {
                return ['code' => 1, 'msg' => 'error'];
            }
        } catch (\Exception $e) {
            return ['code' => 1, 'msg' => $e->getMessage()];
        }
    }

}
