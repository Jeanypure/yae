<?php

namespace backend\controllers;

use Yii;
use backend\models\Goodssku;
use backend\models\SkuVendor;
use backend\models\GoodsskuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * GoodsskuController implements the CRUD actions for Goodssku model.
 */
class GoodsskuController extends Controller
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
     * Lists all Goodssku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsskuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goodssku model.
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


    public function actionCreate()
    {
        $goodssku = new Goodssku();
        $sku_vendor = new  SkuVendor();
        $post = Yii::$app->request->post();
        if(isset($post['Goodssku'])&&isset($post['SkuVendor'])){
            if($goodssku->validate() && $sku_vendor->validate())//这里是先验证数据，如果通过再save()。
            {
                $goodssku->attributes=$post['Goodssku'];
                $sku_vendor->attributes=$post['SkuVendor'];
                $goodssku->pd_creator = Yii::$app->user->identity->username;
                $goodssku->sale_company = implode(",", $post['Goodssku']['sale_company']);
                $goodssku->vendor_code = $post['SkuVendor']['vendor_code'];
                $goodssku->save(false);
                $sku_vendor->sku_id = $goodssku->primaryKey;
                $sku_vendor->save(false);
            }else{
                return $this->redirect(['index']);
            }

        }
        return $this->redirect(['index']);

    }

    /**
     * Updates an existing Goodssku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $goodssku = $this->findModel($id);
        $sku_vendor = SkuVendor::find()->where(['sku_id'=>$id])->one();
        $goodssku->sale_company = explode(',',$goodssku->sale_company); //ActiveForm 指定已存的销售公司
        $post = Yii::$app->request->post();
        if(isset($post['Goodssku'])&&isset($post['SkuVendor'])){
            $goodssku->attributes=$post['Goodssku'];
            $sku_vendor->attributes=$post['SkuVendor'];
            $goodssku->sale_company = implode(",", $post['Goodssku']['sale_company']);
            $goodssku->vendor_code = $post['SkuVendor']['vendor_code'];
            $goodssku->save(false);
            $sku_vendor->save(false);
            return $this->redirect(['index']);
        }



        return $this->render('update', [
            'model' => $goodssku,
             'sku_vendor' => $sku_vendor
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        try{
            Yii::$app->db->createCommand("delete from sku_vendor where  sku_id = $id ")->execute();
        }catch (\Exception $e){
            throw $e;
        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the Goodssku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goodssku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goodssku::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public  function  actionVendorUpdate($id){

        $vendor_model =  SkuVendor::findOne($id);

        if ($vendor_model->load(Yii::$app->request->post()) ) {
            $vendor_model->update_date = date('Y-m-d H:i:s');
            if($vendor_model->save()){
                return $this->redirect(['update', 'id' => $vendor_model->sku_id]);
            }

        }

        return $this->renderAjax('vendor_update', [
            'model' => $vendor_model,
            'sku_id' => $id,
        ]);
    }

     public  function  actionVendorCreate($id){
         $vendor_model = new SkuVendor();
         if ($vendor_model->load(Yii::$app->request->post()) ) {
                 if($vendor_model->save()){
                     return $this->redirect(['update', 'id' => $vendor_model->sku_id]);
                 }

         }else{
             if (isset($id) && !empty($id)) {
                 $vendor_model->sku_id = $id;
                 $vendor_model->save();
             }
         }

         return $this->renderAjax('vendor_create', [
             'model' => $vendor_model,
         ]);
     }

     public  function  actionVendorDelete($id){
         $vendor = SkuVendor::find()->where(['id' => $id])->one();

         if ($vendor->delete()) {
             echo 1;
             Yii::$app->end();
         }
         echo 0;
         Yii::$app->end();
     }

    /**
     * @param null $id
     * @throws \yii\base\ExitException
     * @throws \yii\db\Exception
     */

    public function  actionCopy($id = null)
    {

        $db = Yii::$app->db;
        $outerTransaction = $db->beginTransaction();
        try {
            $resullt = $db->createCommand("
                INSERT INTO goodssku (sku,pd_title,pd_title_en,declared_value,currency_code,old_sku,is_quantity_check,contain_battery,pd_length,pd_width,pd_height,pd_weight,qty_of_ctn,ctn_length,ctn_width,ctn_height,ctn_fact_weight,
                    sale_company,vendor_code,origin_code,min_order_num,pd_get_days,pd_costprice_code,pd_costprice,bill_name,bill_unit,pd_creator,brand,sku_mark,
                    pur_info_id,image_url,pur_group,sku_create_date,sku_update_date) 
                    SELECT sku,pd_title,pd_title_en,declared_value,currency_code,old_sku,is_quantity_check,contain_battery,pd_length,pd_width,pd_height,pd_weight,qty_of_ctn,ctn_length,ctn_width,ctn_height,ctn_fact_weight,
                    sale_company,vendor_code,origin_code,min_order_num,pd_get_days,pd_costprice_code,pd_costprice,bill_name,bill_unit,pd_creator,brand,sku_mark,
                    pur_info_id,image_url,pur_group,sku_create_date,sku_update_date FROM goodssku WHERE sku_id=$id;
            ")->execute();
            $innerTransaction = $db->beginTransaction();
            try {
                $to_vendor = $db->createCommand("
                	-- 创建记录到供应商表
					 INSERT INTO sku_vendor (sku_id)
					 SELECT  LAST_INSERT_ID() ;
            ")->execute();
                $innerTransaction->commit();
            } catch (\Exception $e) {
                $innerTransaction->rollBack();
                throw $e;
            }
            $outerTransaction->commit();

        } catch (\Exception $exception) {
            $outerTransaction->rollBack();
            throw $exception;
        }

        if ($resullt) {
            echo 1;
            Yii::$app->end();
        }
        echo 0;
        Yii::$app->end();
    }


    /**
     * Commit product
     * @throws \yii\db\Exception
     */
    public function actionCommit()
    {
        $ids = $_POST['id'];
        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `goodssku` set `has_commit`= 1 where `sku_id` in ($ids)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }

    }

    /**
     * @throws \yii\base\ExitException
     */
    public function actionCancel()
    {

        $ids = $_POST['id'];
        if(isset($ids)&&!empty($ids)){
            try{
                $res = Yii::$app->db->createCommand("
             update `goodssku` set `has_commit`= 0 where `sku_id` in ($ids)
            ")->execute();

            }catch(\Exception $exception){
                throw $exception;
            }
            if($res){
                echo 'success';
                Yii::$app->end();
            }
        }else{
            echo 'error';
            Yii::$app->end();
        }


    }


}
