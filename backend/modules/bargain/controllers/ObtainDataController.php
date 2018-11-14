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

    public function  actionIntoDatabase(){
       $result = $this->actionDoCurl();
       $requisition_arr = json_decode($result,true);
       if($requisition_arr['message']=='OK'&&$requisition_arr['code']==0){
           $arr = [] ;
           $arr_set = [];
           foreach ($requisition_arr['list'] as $key=>$value){
                $arr[] = $value['id'];
                $arr[] = $value['columns']['trandate'];
                $arr[] = $value['columns']['tranid'];
                $arr[] = $value['columns']['entity']['name'];
                $arr_set[] = $arr;

           }

           $table = 'requisition_list';
           $arr_key = [
               'internal_id',
               'requisition_date',
               'document_number',
               'requisition_name'
           ];

          $sql = $this->actionMultArray2Insert($table,$arr_key, $arr_set);
          return $sql;
        // $response = Yii::$app->db->createCommand($into_requisitionlist_sql)->execute();
         // return $response;

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

    /**

     * 多条数据同时转化成插入SQL语句

     * @ CreatBy:IT自由职业者

     * @param string $table 表名

     * @$arr_key是表字段名的key：$arr_key=array("field1","field2","field3")

     * @param array $arr是字段值 数组示例 arrat(("a","b","c"), ("bbc","bbb","caaa"),('add',"bppp","cggg"))

     * @return string

     */

    public  function actionMultArray2Insert($table,$arr_key, $arr, $split = '`') {

        $arrValues = array();

        if (empty($table) || !is_array($arr_key) || !is_array($arr)) {

            return false;

        }

        $sql = "INSERT INTO %s( %s ) values %s ";

        foreach ($arr as $k => $v) {

            $arrValues[$k] = "'".implode("','",array_values($v))."'";

        }

        $sql = sprintf($sql, $table, "{$split}" . implode("{$split} ,{$split}", $arr_key) . "{$split}", "(" . implode(") , (", array_values($arrValues)) . ")");

        return $sql;

    }



}
