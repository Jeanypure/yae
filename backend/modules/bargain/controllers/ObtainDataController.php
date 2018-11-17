<?php

namespace backend\modules\bargain\controllers;

use Yii;
use  yii\web\Controller;
use linslin\yii2\curl;
class ObtainDataController extends Controller
{
    public function action()
    {
        return [
            'error' =>[
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * cURL GET example
     */
    public  function  actionGetExample()
    {
        //Init curl
        $curl = new curl\Curl();
        $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=1';
        $params = '';
        $response = $curl->get($url,$params);

    }

    public function  actionToList(){
       $result = $this->actionDoCurl();
       $requisition_arr = json_decode($result,true);
       if($requisition_arr['message']=='OK'&&$requisition_arr['code']==0){
           $arr_set = [];
           foreach ($requisition_arr['list'] as $key=>$value){
                   $arr = [] ;
                   $arr[] = $value['id'];
                   $arr[] = $value['columns']['trandate'];
                   $arr[] = $value['columns']['tranid'];
                   $arr[] = $value['columns']['entity']['name'];
                   $arr_set[] = $arr;
                   unset($arr);

           }

           $table = 'requisition_list';
           $arr_key = [
               'internal_id',
               'requisition_date',
               'document_number',
               'requisition_name'
           ];
           $response = Yii::$app->db2->createCommand()->batchInsert($table,$arr_key,$arr_set)->execute();
          return $response;

       }
    }

    public  function actionDoCurl()
    {
        $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=1';
        $ch = curl_init();
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






}
