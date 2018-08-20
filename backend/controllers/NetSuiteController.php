<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/20
 * Time: 13:03
 */

namespace backend\controllers;
use Yii;

class NetSuiteController extends \yii\base\Controller
{
        public  function  actionDoCurl(){

            try{
                $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=116&deploy=8';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: NLAuth nlauth_account=5151251, nlauth_email=618816@163.com, nlauth_signature=AAAbbb1234, nlauth_role=1013',
                    'Content-Type: application/json',
                    'Accept: application/json'
                ));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
                    array(
                        "itemid" => "Testhaha666",
                        "taxschedule" => "1"
                    )
                )));
                ob_start();
                curl_exec($ch);
                $result = ob_get_contents();
                ob_end_clean();
                curl_close($ch);
                print_r($result);
            }catch (\Exception $exception){
                throw $exception;
            }


        }
}