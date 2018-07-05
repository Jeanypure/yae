<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/7/4
 * Time: 11:25
 */

namespace backend\controllers;
use Yii;
//use linslin\yii2\curl;

class WinitController  extends \yii\base\Controller
{

//  public function  actionIndex(){
//      $url = 'http://api.winit.com.cn/ADInterface/api';
//      $curl = new curl\Curl();
//
//      $str_json = '{"action":"queryWarehouse","app_key":"amarinestore@gmail.com","data":{},"format":"json","language":"zh_CN","platform":"YYNETSUITE","sign":"564B2C2916E11B39A1BA11CD68ADAAD4","sign_method":"md5","timestamp":"","version":"1.0","client_id":"NDK1ODCWMZITMDRMNC00YZJILWFLMMITZGQYOTFKOTDJNWZM","client_sign":"237E38239B723F1A3453615DAEB50B4E"}';
//
//      //get http://example.com/ get请求改网址
//      $response = $curl
//          ->reset()
//          ->setRequestBody($str_json)
//          ->post($url);
//    // curl对象有errorCode和errorerrorText 属性,分别为错误代码和错误说明
//      if ($curl->errorCode === null) {
//          echo $response;
//      } else {
//          // 可以从这里获得所有的错误代码 https://curl.haxx.se/libcurl/c/libcurl-errors.html
//          switch ($curl->errorCode) {
//
//              case 6:
//                  //host unknown example
//                  break;
//          }
//      }
//  }


    public  function actionRequest(){
      $base_url = 'http://api.winit.com.cn/ADInterface/api';
      $data = '{"action":"queryWarehouse","app_key":"amarinestore@gmail.com","data":{},"format":"json","language":"zh_CN","platform":"YYNETSUITE","sign":"564B2C2916E11B39A1BA11CD68ADAAD4","sign_method":"md5","timestamp":"","version":"1.0","client_id":"NDK1ODCWMZITMDRMNC00YZJILWFLMMITZGQYOTFKOTDJNWZM","client_sign":"237E38239B723F1A3453615DAEB50B4E"}';
      echo $this->actionDoCurlPostRequest($base_url, $data);
    }

    public function actionDoCurlPostRequest($url,$requestString,$timeout = 5){
        if($url == '' || $requestString == '' || $timeout <=0){
            return false;
        }
        $con = curl_init((string)$url);
        curl_setopt($con, CURLOPT_HEADER, false);
        curl_setopt($con, CURLOPT_POSTFIELDS, $requestString);
        curl_setopt($con, CURLOPT_POST,true);
        curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($con, CURLOPT_TIMEOUT,(int)$timeout);
        return curl_exec($con);
    }




}