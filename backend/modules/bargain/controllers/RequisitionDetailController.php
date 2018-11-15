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
     public  function actionSigleCurl(){
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

     public function actionRequestDetail(){
         $sql = 'select internal_id from requisition_list';
         $idSet = Yii::$app->db2->createCommand($sql)->queryAll();
         $ids = array_column($idSet,'internal_id');
         $multiCurl = [];
         $result = [];
         $mh = curl_multi_init();
         foreach ($ids as $i=>$id){
             $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=2&id='.$id;
             $multiCurl[$i] = curl_init();
             curl_setopt($multiCurl[$i], CURLOPT_HEADER,0);
             curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER,1);
             curl_setopt($multiCurl[$i],CURLOPT_URL,$url);
             curl_setopt($multiCurl[$i],CURLOPT_HTTPHEADER,['Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
                 'Content-Type: application/json',
                 'Accept: application/json']);
             curl_multi_add_handle($mh, $multiCurl[$i]);
             }
             $index = null;
             do{
                 $mrc = curl_multi_exec($mh,$index);
             }while( $mrc == CURLM_CALL_MULTI_PERFORM);
              foreach($multiCurl as $k =>$ch){
                  $result[$k] = curl_multi_getcontent($ch);
                  curl_multi_remove_handle($mh,$ch);
              }
              //close
              curl_multi_close($mh);

              return json_encode($result);
     }
}