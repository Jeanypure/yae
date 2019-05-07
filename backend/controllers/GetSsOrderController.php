<?php

namespace backend\controllers;

class GetSsOrderController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param $ssid
     * 获取ShipStation订单
     */
    public  function actionGetOrder(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://ssapi.shipstation.com/orders/530541141");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic MjE2Yzk0ZGEwOTdiNGU0NGE3MGFhNzgwYmU0YTc2ZWM6MmNiMDM1ZDZhNGE3NGUxZWE5NzkxZjczMmRiMTAzMjE="
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }

}
