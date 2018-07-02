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
        $model = $this->findModel($id);
        $fee_model = FreightFee::find()->where(['freight_id'=>$id])->all();
        $result  = FeeCategory::find()->orderBy('id')->asArray()->all();
        if ($model->load(Yii::  $app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $query = FreightFee::find()->indexBy('id')->where(['freight_id'=>$id]); // where `id` is your primary key
//        echo $query->createCommand()->getRawSql();die;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

//        if (Yii::$app->request->post('hasEditable')) {
//            // instantiate your book model for saving
//            $bookId = Yii::$app->request->post('editableKey');
//            $model = FreightFee::findOne($bookId);
//
//            // store a default json response as desired by editable
//            $out = Json::encode(['output'=>'', 'message'=>'']);
//
//            // fetch the first entry in posted data (there should only be one entry
//            // anyway in this array for an editable submission)
//            // - $posted is the posted data for Book without any indexes
//            // - $post is the converted array for single model validation
//            $posted = current($_POST['Book']);
//            $post = ['Book' => $posted];
//
//            // load model like any single model validation
//            if ($model->load($post)) {
//                // can save model or do something before saving model
//                $model->save();
//
//                // custom output to return to be displayed as the editable grid cell
//                // data. Normally this is empty - whereby whatever value is edited by
//                // in the input by user is updated automatically.
//                $output = '';
//
//                // specific use case where you need to validate a specific
//                // editable column posted when you have more than one
//                // EditableColumn in the grid view. We evaluate here a
//                // check to see if buy_amount was posted for the Book model
//                if (isset($posted['buy_amount'])) {
//                    $output = Yii::$app->formatter->asDecimal($model->buy_amount, 2);
//                }
//
//                // similarly you can check if the name attribute was posted as well
//                // if (isset($posted['name'])) {
//                // $output = ''; // process as you need
//                // }
//                $out = Json::encode(['output'=>$output, 'message'=>'']);
//            }
//            // return ajax json encoded response and exit
//            echo $out;
//            return;
//        }



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


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' =>$id]);
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
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update','id' =>$model->freight_id ]);
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

//        return $this->redirect(['update','id' =>$feecat->freight_id ]);


    }
}
