<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/11/15
 * Time: 15:59
 */

namespace backend\modules\bargain\controllers;

use Yii;
use yii\web\Controller;
use linslin\yii2\curl;
class RequisitionDetailController extends Controller
{
     public  function actionIndex()
     {
         echo 123;
     }
     public  function actionSingleCurl(){
       $ch = curl_init();
       $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=2&id=170086';
         curl_setopt($ch, CURLOPT_HTTPHEADER,[
             'Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
             'Content-Type: application/json',
             'Accept: application/json'
         ]);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
         curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
         curl_setopt($ch, CURLOPT_URL, $url);
         ob_start();
         curl_exec($ch);
         $result = ob_get_contents();
         ob_end_clean();
         curl_close($ch);
         return $result;

     }

     public function actionMultiRequest(){
         $sql = 'select internal_id from requisition_list ORDER BY internal_id DESC limit 1,3';
         $idSet = Yii::$app->db2->createCommand($sql)->queryAll();
         $ids = array_column($idSet,'internal_id');
         $multiCurl = [];
         $result = [];
         $mh = curl_multi_init();
         ini_set('max_execution_time', 300);
         foreach ($ids as $i=>$id){
             $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=2&id='.$id;
             $multiCurl[$i] = curl_init();
             curl_setopt($multiCurl[$i],CURLOPT_HTTPHEADER,['Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
                 'Content-Type: application/json',
                 'Accept: application/json']);
             curl_setopt($multiCurl[$i], CURLOPT_HEADER,0);
             curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER,1);
             curl_setopt($multiCurl[$i], CURLOPT_FOLLOWLOCATION, 1);
             curl_setopt($multiCurl[$i],CURLOPT_SSL_VERIFYHOST,2);
             curl_setopt($multiCurl[$i],CURLOPT_SSL_VERIFYPEER,false);
             curl_setopt($multiCurl[$i],CURLOPT_URL,$url);
             curl_multi_add_handle($mh, $multiCurl[$i]);
             }
         $active = null;
        //execute the handles
         do {
             $mrc = curl_multi_exec($mh, $active);
         } while ($mrc == CURLM_CALL_MULTI_PERFORM);

         while ($active && $mrc == CURLM_OK) {
             if (curl_multi_select($mh) != -1) {
                 do {
                     $mrc = curl_multi_exec($mh, $active);
                 } while ($mrc == CURLM_CALL_MULTI_PERFORM);
             }
         }


         foreach($multiCurl as $k =>$ch){
                  $result[$k] = curl_multi_getcontent($ch);
                  curl_multi_remove_handle($mh,$ch);
              }
              //close
              curl_multi_close($mh);

              return json_encode($result,true);
     }

    /**
     * 入库进入requisition_detail 表
     */
     public  function actionToDetail(){
         $result = $this->actionMultiCurl();

         $resultArr = json_decode($result,true);
         if(empty($resultArr['error'])){
             $tableName = 'requisition_detail';
             $columnKey = ['tranid','amount','description','item_internal_id','item_name',
//                 'linkedorder_internalid','linkedorder_name','linkedorderstatus',
                 'povendor_internalid','povendor_name','quantity','rate',
//                 'createdate','lastmodifieddate','trandate','currencyname'
             ];
             $recordArr = [];
             $record = [];

             foreach($resultArr as $key=>$value){
                 $value = json_decode($value,true);
                 $record[] = $value['tranid'];
                 foreach($value['item'] as $k=>$v){
                     $record[] = $v['amount'];
                     $record[] = $v['description'];
                     $record[] = $v['item']['internalid'];
                     $record[] = $v['item']['name'];
                     if(!empty($v['povendor'])){
                         $record[] = $v['povendor']['internalid'];
                         $record[] = $v['povendor']['name'];
                     }
                     $record[] = $v['quantity'];
                     $record[] = $v['rate'];
                     $recordArr[]  = $record;

                     var_dump($recordArr);die;
                 }

//                 $res =  Yii::$app->db2->createCommand($tableName,$columnKey,$recordArr)->batchInsert()->execute();
//                 unset($recordArr);

             }

         }



     }
}