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


    /**
     * @param $id
     * @return array|string
     * @throws \yii\db\Exception
     */
   public function actionExportNs($id){
       $sql = "SELECT 
                    g.internalid,g.sku,g.pd_title,g.pd_title_en,g.pd_weight,g.pd_length,g.pd_width,g.pd_height,
                    g.declared_value,g.currency_code,g.pd_costprice,g.pd_costprice_code,g.vendor_code,
                    g.is_quantity_check, g.contain_battery,g.qty_of_ctn,g.ctn_length,g.pd_width,g.pd_height,
                    g.ctn_width, g.ctn_height, g.ctn_fact_weight, g.pd_creator, g.sale_company,g.sku_mark,g.hs_code,
                    g.declaration_item_key1,g.declaration_item_value1,g.declaration_item_key2,g.declaration_item_value2,
                    g.declaration_item_key3,g.declaration_item_value3,g.declaration_item_key4,g.declaration_item_value4,
                    g.declaration_item_key5,g.declaration_item_value5,g.declaration_item_key6,g.declaration_item_value6,
                    g.declaration_item_key7,g.declaration_item_value7,g.declaration_item_key8,g.declaration_item_value8,
                    g.declaration_item_key9,g.declaration_item_value9,g.material,g.use,
                    s.brand,s.bill_name,s.bill_unit,s.origin_code,
                    o.url_1688
                    FROM goodssku g LEFT JOIN sku_vendor s ON g.sku_id=s.sku_id  AND g.vendor_code = s.vendor_code  
                    LEFT JOIN pur_info o ON o.pur_info_id=g.pur_info_id
                where  g.sku_id = $id ";
       $result =  Yii::$app->db->createCommand("$sql")->queryAll();
       $contain_battery = empty($result[0]['contain_battery'])?FALSE:TRUE;
       $is_quantity_check = empty($result[0]['is_quantity_check'])?FALSE:TRUE;
       $sale_company =  explode(',',$result[0]['sale_company']);
        if (in_array(9,$sale_company)){
            $sale_company =['2','9'];
        }
        $item_min = [
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
//           "usebins" => 'T',
            "usebins" => TRUE,
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
           'salesdescription' => $result[0]['pd_title'],
           'custitem_cs_1688linkurl' => $result[0]['url_1688'],
       ];
        $recordtype = ['recordtype' => 'LotNumberedInventoryItem'];
        $item_arr =  array_merge($item_min,$recordtype);
        $data_arr = [
            'id' => $result[0]['internalid'],
            'recordtype' => 'LotNumberedInventoryItem',
            'fields' => $item_min
            ];
        if(isset($result[0]['internalid'])&&!empty($result[0]['internalid'])){
            $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=154&deploy=2';
            $result = $this->actionPutItem(json_encode($data_arr),$url);
        }else {
            $result = $this->actionPostItem($item_arr);
            $internalid = trim($result,'"');
//            $result = $this->actionDoCurl($item_arr);
            //创建记录成功需要把NS中的内部id回写到goodssku表中， 再次导入时做更新操作
            if (strlen($internalid)>=5 && strlen($internalid)<=6) {
                try {
                    Yii::$app->db->createCommand("update goodssku set internalid= '$internalid',has_tons=1 where sku_id=$id ")->execute();
                } catch (\Exception $exception) {
                    throw $exception;
                }
            }
        }
     return $result;
   }


    /**
     * @param $item_arr
     * @return string
     * @throws \Exception
     * suitescript 1.0 version
     */
    public  function  actionDoCurl($item_arr){

        try{
//            $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=116&deploy=8';
            //script=153 version 1.0 创建带编号的库存商品
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
     * put更新已存在的带编号的库存产品
     */
    public static function actionPutItem($data,$url){
        $ch = curl_init(); //初始化CURL句柄
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
            'Content-Type: application/json',
            'Accept: application/json',
            'Content-Length: ' . strlen($data)]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);//设置提交的字符串
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    /**
     * post use SuiteScript 2.0 Version Create LotNumbered Inventory Item
     *
     */
    public function actionPostItem($item_arr)
    {
        $res = AuditSupplierController::actionDoVendorCurl($item_arr);
        return $res;
    }

}
