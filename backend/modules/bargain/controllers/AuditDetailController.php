<?php

namespace backend\modules\bargain\controllers;


use Yii;
use backend\modules\bargain\models\RequisitionDetail;
use backend\modules\bargain\models\VendorDetail;
use backend\modules\bargain\models\VendorDetailCopy;
use backend\modules\bargain\models\RequisitionDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuditDetailController implements the CRUD actions for RequisitionDetail model.
 */
class AuditDetailController extends Controller
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
     * Lists all RequisitionDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequisitionDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequisitionDetail model.
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
     * Creates a new RequisitionDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequisitionDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RequisitionDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $vendor_detail= VendorDetail::find()->where(['internalid' =>$model->povendor_internalid])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'vendor_detail' => $vendor_detail
        ]);
    }

    /**
     * Deletes an existing RequisitionDetail model.
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
     * Finds the RequisitionDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequisitionDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequisitionDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * 同步更新请购单
     */
    public function  actionPostItem($id){
    $model = $this->findModel($id);
    $record = [];
    $record['id'] = $model->tran_internal_id;
    $record['tranid'] = $model->tranid;
    $externalItems = [];
    $lineItem['description']  = $model->description;
    $internalItem['internalid'] = $model->item_internal_id;
    $internalItem['name'] = $model->item_name;
    $lineItem['custcol_after_bargain'] = $model->after_bargain_price;
    $lineItem['custcol_negotiant'] = $model->negotiant;
    $lineItem['custbodym_contract_types'] = false;
    $lineItem['item']  = $internalItem;
    $externalItems[] = $lineItem;
    $record['item'] = $externalItems;
    $url1 = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=3';
    $res = $this->actionDoCurl($record,$url1);
    $ret = $this->actionUpdateVendor($model);
        if($res=='"'.$model->tran_internal_id.'"' && $ret == '"'.$model->povendor_internalid.'"'){
            $model->audit_status = 1;
            $model->save(false);
                echo 'success!';
            }else{
                echo 'error!';
            }


    }

    /**
     * @param $item_arr
     * @return string
     * @throws \Exception
     */
    public  function  actionDoCurl($item_arr,$url){

        try{

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1047',
                'Content-Type: application/json',
                'Accept: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($item_arr));
            ob_start();
            curl_exec($ch);
            $result = ob_get_contents();
            ob_end_clean();
            curl_close($ch);
            return $result;
        }catch (\Exception $exception){
            throw $exception;
        }


    }

    /**
     * post同步更新供应商信息
     *
     */
    public function actionUpdateVendor($model){
        $vendor_detail= VendorDetailCopy::find()->where(['internalid' =>$model->povendor_internalid])->one();
        $vendorItem = [];
        $vendorItem['id'] = $model->povendor_internalid;
        $vendorItem['recordtype'] = 'vendor';
        $fields['entityid'] = $vendor_detail->supplier_code;
        $fields['companyname'] = $vendor_detail->supplier_name;
        $fields['custentity_qq_number'] = $vendor_detail->contact_qq;
        $fields['phone'] = $vendor_detail->contact_tel;
        $fields['custentity_attention'] = $vendor_detail->contact_name;
        $fields['custentity_invoice_type'] = $vendor_detail->bill_type;
        $fields['custentitypayment_method'] = $vendor_detail->payment_method;
        $vendorItem['fields'] = $fields;
        $url2 = "https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=154&deploy=2";
        $ret = $this->actionPutUrl(json_encode($vendorItem),$url2);
        return $ret;
    }

    function actionPutUrl($data,$url){
        $ch = curl_init(); //初始化CURL句柄
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HTTPHEADER,[
            'Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
            'Content-Type: application/json',
            'Accept: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);//设置提交的字符串
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }




}
