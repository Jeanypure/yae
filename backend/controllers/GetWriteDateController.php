<?php

namespace backend\controllers;



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
        echo 123;
//        echo json_encode($result);
    }

    public  function actionDoCurl($url)
    {
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

