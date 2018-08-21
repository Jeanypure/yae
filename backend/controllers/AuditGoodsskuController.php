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
class AuditGoodsskuController extends Controller
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

    /**
     * Creates a new Goodssku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goodssku();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->pd_creator = Yii::$app->user->identity->username;
            $model->save(false);
            try{
                Yii::$app->db->createCommand("
             INSERT into sku_vendor(sku_id) SELECT max(sku_id) FROM  goodssku;
            ")->execute();

            }catch (\Exception $exception){
                throw  $exception;
            }
            return $this->redirect(['view', 'id' => $model->sku_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $model->sku_update_date = date('Y-m-d H:i:s');
            return $this->redirect(['view', 'id' => $model->sku_id]);
        }

        $query = SkuVendor::find()->andwhere(['sku_id' => $id]);
        $vendor_model = SkuVendor::find()->where(['sku_id' => $id])->all();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->render('update', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'vendor_model' => $vendor_model[0],
            'sku_id'=>$id
        ]);
    }

    /**
     * Deletes an existing Goodssku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
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


    public function actionExport($id = null)
    {
        $objPHPExcel = new \PHPExcel();
        $header = [
            'A1' => '产品SKU',
            'B1' => '产品名称',
            'C1' => '产品英文名称',
            'D1' => '产品品类（代码）',
            'E1' => '重量',
            'F1' => '长',
            'G1' => '宽',
            'H1' => '高',
            'I1' => '海关申报代码',
            'J1' => '英文申报品名',
            'K1' => '中文申报品名',
            'L1' => '申报价值',
            'M1' => '申报币种',
            'N1' => '采购价',
            'O1' => '采购币种',
            'P1' => '默认供应商代码',
            'Q1' => '销售价格',
            'R1' => '销售运费',
            'S1' => '建立原因',
            'T1' => '供应商产品地址',
            'U1' => '供应商品号',
            'V1' => '款式代码',
            'W1' => '成品',
            'X1' => '运营方式',
            'Y1' => '贴标容易度',
            'Z1' => '产品销售状态',
            'AA1' => '销售负责人',
            'AB1' => '开发负责人',
            'AC1' => '自定义分类',
            'AD1' => '是否需要质检',
            'AE1' => '组织机构（代码）',
            'AF1' => '申报说明',
            'AG1' => '是否包含电池',
            'AH1' => '是否为仿制品',
            'AI1' => '最小采购量',
            'AJ1' => '交期',
            'AK1' => '中文描述',
            'AL1' => '英文描述',
            'AM1' => '净重',
            'AN1' => 'EAN码',
            'AO1' => '产品单位代码',
            'AQ1' => 'UPC码',

        ];
        //设置表格头的输出
        foreach ($header as $key => $value) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$key", "$value");
        }
       $sql = "
                SELECT sku,pd_title,pd_title_en,pd_weight,pd_length,pd_width,pd_height,
                declared_value,currency_code,pd_costprice,pd_costprice_code,vendor_code
                 FROM goodssku  
                where  sku_id in ($id)
                ;
        ";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $company = Yii::$app->db->createCommand("select sub_company,memo from company")->queryAll();
        $company_arr = [];
        foreach ($company as $key => $val) {
            $company_arr[$val['sub_company']] = $val['memo'];
        }


        foreach ($data as $k => $v) {
            $num = 2;
            $num = $num + $k;
            $objPHPExcel->setActiveSheetIndex(0)
                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                ->setCellValue('A' . $num, $v['sku'])
                ->setCellValue('B' . $num, $v['pd_title'])
                ->setCellValue('C' . $num, $v['pd_title_en'])
                ->setCellValue('E' . $num, $v['pd_weight'])
                ->setCellValue('F' . $num, $v['pd_length'])
                ->setCellValue('G' . $num, $v['pd_width'])
                ->setCellValue('H' . $num, $v['pd_height'])
                ->setCellValue('J' . $num, $v['pd_title_en'])
                ->setCellValue('K' . $num, $v['pd_title'])
                ->setCellValue('L' . $num, $v['declared_value'])
                ->setCellValue('M' . $num, $v['currency_code'])
                ->setCellValue('N' . $num, $v['pd_costprice'])
                ->setCellValue('O' . $num, $v['pd_costprice_code'])
                ->setCellValue('P' . $num, $v['vendor_code'])
            ;
        }

        //设置工作簿的名称
        $objPHPExcel->getActiveSheet()->setTitle('产品');


        //创建第二个工作表
        $msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '产品图片'); //创建2个工作表
        $objPHPExcel->addSheet($msgWorkSheet); //插入工作表
        $objPHPExcel->setActiveSheetIndex(1); //切换到新创建的工作表
        $header_arr2 = [
            'A1' => '产品SKU',
            'B1' => '图片URL',
            'C1' => '是否主图(Y/N)'
        ];
        //设置表格头的输出
        foreach($header_arr2 as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue("$key", "$value");
        }

        //创建第3个工作表
        $msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '产品包材'); //创建3个工作表
        $objPHPExcel->addSheet($msgWorkSheet); //插入工作表
        $objPHPExcel->setActiveSheetIndex(2); //切换到新创建的工作表
        $header_arr3 = [
            'A1' => '产品SKU',
            'B1' => '包材代码',
            'C1' => '包材数量',
            'D1' => '仓库代码',
        ];
        //设置表格头的输出
        foreach($header_arr3 as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("$key", "$value");
        }

        //创建第4个工作表
        $msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '基础数据（供应商_产品单位）'); //创建4个工作表
        $objPHPExcel->addSheet($msgWorkSheet); //插入工作表
        $objPHPExcel->setActiveSheetIndex(3); //切换到新创建的工作表
        $header_arr4 = [
            'A1' => '供应商代码',
            'B1' => '供应商名称',
            'D1' => '产品单位代码',
            'E1' => '产品单位名称',
        ];
        //设置表格头的输出
        foreach($header_arr4 as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue("$key", "$value");
        }

        //创建第5个工作表
        $msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '基础数据（产品品类）'); //创建5个工作表
        $objPHPExcel->addSheet($msgWorkSheet); //插入工作表
        $objPHPExcel->setActiveSheetIndex(4); //切换到新创建的工作表
        $header_arr5 = [
            'A1' => '品类ID',
            'B1' => '等级',
            'C1' => '品类中文名称',
            'D1' => '品类英文名称',
        ];
        //设置表格头的输出
        foreach($header_arr5 as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue("$key", "$value");
        }


        //数据结束

        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="导产品到易仓表格.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }

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
     * Cancel commit goodssku
     * @throws \yii\db\Exception
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
