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
class RequisitionRequestController extends Controller
{
     public  function actionIndex()
     {
         $startDate = date('Y/m/d',strtotime('-7 day'));
         $endDate = date('Y/m/d');
         echo  $startDate,$endDate;
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

     public function actionMultiRequest($startDate,$endDate){
         if(empty($startDate)&&empty($endDate)){
             $startDate = date('Y-m-d H:i:s',strtotime('-40 day'));
             $endDate = date('Y-m-d H:i:s');
         }
         $sql = "select internal_id from requisition_list where requisition_date between '$startDate' and  '$endDate';";
         $idSet = Yii::$app->db->createCommand($sql)->queryAll();
         $ids = array_column($idSet,'internal_id');
         $multiCurl = [];
         $result = [];
         set_time_limit(0);
         $mh = curl_multi_init();
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
             usleep(50000);
//             if (curl_multi_select($mh) != -1) {
                 do {
                     $mrc = curl_multi_exec($mh, $active);
                 } while ($mrc == CURLM_CALL_MULTI_PERFORM);
//             }
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
     public  function actionToDetail($startDate=null,$endDate=null){
         $result = $this->actionMultiRequest($startDate,$endDate);
         $resultArr = json_decode($result,true);
         if(empty($resultArr['error'])){
             $tableName = 'requisition_detail';
             $columnKey = ['tran_internal_id','tranid','amount','description','item_internal_id','item_name',
                 'povendor_internalid','povendor_name','quantity','rate',
                 'createdate'
             ];
             $recordArr = [];
             $record = [];

             foreach($resultArr as $key=>$value){
                 $value = json_decode($value,true);
                 if(!empty($value['item'] )){
                     foreach($value['item'] as $k=>$v){
                         $record[] = $value['id'];
                         $record[] = $value['tranid'];
                         $record[] = $v['amount'];
                         if(!empty($v['description'])){
                             $record[] = $v['description'];
                         }else{
                             $record[] = '';
                         }
                         $record[] = $v['item']['internalid'];
                         $record[] = $v['item']['name'];
                         if(!empty($v['povendor'])){
                             $record[] = $v['povendor']['internalid'];
                             $record[] = $v['povendor']['name'];
                         }else{

                             $record[] = '';
                             $record[] = '';
                         }
                         $record[] = $v['quantity'];
                         $record[] = empty($v['rate'])?$v['rate']:0;
                         $record[] = $value['createddate'];
                         $sql = "select count(*) as num from requisition_detail
                           where tran_internal_id='$value[id]' and item_name='".$v['item']['name']."' and quantity=$v[quantity]";
                         $resNum = Yii::$app->db->createCommand($sql)->queryOne();
                         if($resNum['num']){
                             unset($record);
                           continue;
                         }

                         $recordArr[]  = $record;
                         unset($record);

                     }
                     if(isset($recordArr)&&!empty($recordArr)){
                         $res =  Yii::$app->db->createCommand()->batchInsert($tableName,$columnKey,$recordArr)->execute();
                         unset($recordArr);
                     }

                 }
             }
         }



     }
}