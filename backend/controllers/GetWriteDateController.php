<?php

namespace backend\controllers;

use Yii;
use backend\modules\bargain\controllers\ObtainDataController;

class GetWriteDateController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 获取到货单
     */
    public function  actionGetReceipt(){
        $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=284&deploy=1';
        $result = ObtainDataController::actionDoCurl($url);
        $res_arr = json_decode($result,true);
        $record_set = [];
        if(is_array($res_arr)){
            foreach ($res_arr as $key=>$value){
                $record = [];
                $record[] = $value['trandate'];
                $record[] = $value['tranid'];
                $record[] = $value['potext'];
                $record[] = $value['itemsku'];
                $record[] = $value['itemdescription'];
                $record[] = $value['quantity'];
                $record_set[] = $record;
                unset($record);
            }
        }
        $table = 'tb_item_receipt';
        $column = ['receipt_date','receipt_no','purchase_no','sku','item_name','quantity'];
        Yii::$app->db->createCommand('truncate table tb_item_receipt')->execute();
        $res = Yii::$app->db->createCommand()->batchInsert($table,$column,$record_set)->execute();
        return json_encode($res,true);
    }

    /**
     * 获取采购明细
     */
    public function  actionGetPurchaseOrder(){
       $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=289&deploy=1';
       $result = ObtainDataController::actionDoCurl($url);
       $res_arr = json_decode($result,true);
       $record_set = [];
       if(is_array($res_arr)){
           foreach ($res_arr as $key=>$value){
               $record =[];
               $record[] = $value['trandate'];
               $record[] = $value['tranid'];
               $record[] = $value['itemname'];
               $record[] = $value['quantityshiprecv'];
               $record[] = $value['quantitybilled'];
               $record[] = $value['quantity'];
               $record[] = $value['custcol_invoice_item_name'];
               $record[] = $value['subsidiary'];
               $record[] = $value['department'];
               $record[] = $value['formulanumeric'];
               $record_set[] = $record;
               unset($record);
           }
       }
       echo json_encode($record_set);
       $table = 'tb_purchase_detail';
       $column = ['purchase_date','purchase_order_no','sku','receipt_quantity','requisition_quantity',
           'purchase_quantity','purchaser','subsidiary','department','formulanumeric'];
       Yii::$app->db->createCommand('truncate table tb_purchase_detail')->execute();
       $res = Yii::$app->db->createCommand()->batchInsert($table,$column,$record_set)->execute();
       return json_encode($res,true);
    }


}

