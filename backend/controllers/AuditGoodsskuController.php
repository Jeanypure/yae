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
     * Updates an existing Goodssku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->sale_company = explode(',',$model->sale_company); //ActiveForm 指定已存的销售公司

        if ($model->load(Yii::$app->request->post()) ) {
            $model->sku_update_date = date('Y-m-d H:i:s');
            $model->sale_company = implode(',',$model->sale_company);
            $model->save(false);
            return $this->redirect(['update', 'id' => $model->sku_id]);
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
                    SELECT 
                        g.sku,g.pd_title,g.pd_title_en,g.pd_weight,g.pd_length,g.pd_width,g.pd_height,
                        g.declared_value,g.currency_code,g.pd_costprice,g.pd_costprice_code,g.vendor_code,s.bill_name,s.bill_unit
                        FROM goodssku g LEFT JOIN sku_vendor s ON g.sku_id=s.sku_id  AND g.vendor_code = s.vendor_code  
                    where  g.sku_id in ($id)
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
                ->setCellValue('U' . $num, $v['bill_name'].'/'.$v['bill_unit'])
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

        $this->actionMendEccang($id);

        //数据结束
        $filename = date('Y-m-d')."导产品到易仓.xls";
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }

    /**
     * @param $id
     * @return array|string
     * @throws \yii\db\Exception
     */
   public function actionExportNs($id){
       $sql = "SELECT 
                    g.sku,g.pd_title,g.pd_title_en,g.pd_weight,g.pd_length,g.pd_width,g.pd_height,
                    g.declared_value,g.currency_code,g.pd_costprice,g.pd_costprice_code,g.vendor_code,
                    g.is_quantity_check, g.contain_battery,g.qty_of_ctn,g.ctn_length,g.pd_width,g.pd_height,
                    g.ctn_width, g.ctn_height, g.ctn_fact_weight, g.pd_creator, g.sale_company,g.sku_mark,g.hs_code,
                    g.declaration_item_key1,g.declaration_item_value1,g.declaration_item_key2,g.declaration_item_value2,
                    g.declaration_item_key3,g.declaration_item_value3,g.declaration_item_key4,g.declaration_item_value4,
                    g.declaration_item_key5,g.declaration_item_value5,g.declaration_item_key6,g.declaration_item_value6,
                    g.declaration_item_key7,g.declaration_item_value7,g.declaration_item_key8,g.declaration_item_value8,
                    g.declaration_item_key9,g.declaration_item_value9,g.material,g.use,
                    s.brand,s.bill_name,s.bill_unit,s.origin_code
                    FROM goodssku g LEFT JOIN sku_vendor s ON g.sku_id=s.sku_id  AND g.vendor_code = s.vendor_code  
                where  g.sku_id = $id ";
       $result =  Yii::$app->db->createCommand("$sql")->queryAll();
       $is_quantity_check = empty($result[0]['is_quantity_check'])?'F':'T';
       $contain_battery = empty($result[0]['contain_battery'])?'F':'T';
       $sale_company =  explode(',',$result[0]['sale_company']);

        if($sale_company == [0=>"9"]){
            $sale_company = ["2"];
        }elseif (in_array(9,$sale_company)){
            $sale_company = array_diff($sale_company,['9']);
        }

       $item_arr = [[
           "itemid" => $result[0]['sku'],
           "taxschedule" => "1",
           "custitem_cn_declared_name" => $result[0]['pd_title'],
           "custitem_en_declared_name" => $result[0]['pd_title_en'],
           "custitem_declaredvalue" => $result[0]['declared_value'],
           "custitem2" => $result[0]['vendor_code'],
           "custitem_declaredcurrency" => 2,
           "custitem22" => $is_quantity_check,
           "custitem5" => $contain_battery,
           "custitem_product_weight" => $result[0]['pd_weight'],
           "custitem_item_length" => $result[0]['pd_length'],
           "custitem_item_width" => $result[0]['pd_width'],
           "custitem_item_height" => $result[0]['pd_height'],
           "custitem_qty_per_carton" => $result[0]['qty_of_ctn'],
           "custitem11" => $result[0]['ctn_length'],
           "custitem12" => $result[0]['ctn_width'],
           "custitem13" => $result[0]['ctn_height'],
           "custitem16" => $result[0]['ctn_fact_weight'],
           "custitem_invoice_item_name" => $result[0]['bill_name'],
           "custitem_invoice_unit" => $result[0]['bill_unit'],
           "custitem19" => $result[0]['pd_creator'],
           "custitem21" => $result[0]['brand'],
           "custitem20" => $result[0]['pd_creator'],
           "subsidiary" => $sale_company,
           "custitem24" => $result[0]['hs_code'],
           "lastpurchaseprice" => $result[0]['pd_costprice'],
           "usebins" => 'T',
           "purchasedescription" => $result[0]['pd_title'],
           "custitem_item_spec" => $result[0]['origin_code'],
           "custitemgoodssku_memo" => $result[0]['sku_mark'],
           'custitem_yaosu_name1' => $result[0]['declaration_item_key1'],
           'custitem_yaosu_value1' => $result[0]['declaration_item_value1'],
           'custitem_yaosu_name2' => $result[0]['declaration_item_key2'],
           'custitem_yaosu_value2' => $result[0]['declaration_item_value2'],
           'custitem_yaosu_name3' => $result[0]['declaration_item_key3'],
           'custitem_yaosu_value3' => $result[0]['declaration_item_value3'],
           'custitem_yaosu_name4' => $result[0]['declaration_item_key4'],
           'custitem_yaosu_value4' => $result[0]['declaration_item_value4'],
           'custitem_yaosu_name5' => $result[0]['declaration_item_key5'],
           'custitem_yaosu_value5' => $result[0]['declaration_item_value5'],
           'custitem_yaosu_name6' => $result[0]['declaration_item_key6'],
           'custitem_yaosu_value6' => $result[0]['declaration_item_value6'],
           'custitem_yaosu_name7' => $result[0]['declaration_item_key7'],
           'custitem_yaosu_value7' => $result[0]['declaration_item_value7'],
           'custitem_yaosu_name8' => $result[0]['declaration_item_key8'],
           'custitem_yaosu_value8' => $result[0]['declaration_item_value8'],
           'custitem_yaosu_name9' => $result[0]['declaration_item_key9'],
           'custitem_yaosu_value9' => $result[0]['declaration_item_value9'],
           'custitemm_material' => $result[0]['material'],
           'custitemm_purpose' => $result[0]['use'],
       ]];
        $result = $this->actionDoCurl($item_arr);
        $res = json_decode($result);
        if( isset($res->code)&&$res->code=='200 OK'){
            try{
                Yii::$app->db->createCommand("update goodssku set has_tons=1 where sku_id=$id ")->execute();
            }catch (\Exception $exception){
               throw $exception;
            }
        }
     return $result;
   }

    /**
     * @param $item_arr
     * @return string
     * @throws \Exception
     */
    public  function  actionDoCurl($item_arr){

        try{
//            $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=116&deploy=8';
            $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=153&deploy=2';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
                'Content-Type: application/json',
                'Accept: application/json'
            ));
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
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function actionMendEccang($id){
        try{
          $res = Yii::$app->db->createCommand("update goodssku set has_toeccang=1  where sku_id = $id ")->execute();
        }catch(\Exception $exception){
            throw $exception;
        }
        return 'success';

    }

}
