<?php

namespace backend\modules\bargain\controllers;

use Yii;
use  yii\web\Controller;
use linslin\yii2\curl;
use backend\modules\bargain\models\VendorList;
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

    /**
     * @return mixed
     * m获取最新请购列表
     */

    public function  actionToList(){
       $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=1';
       $result = $this->actionDoCurl($url);
       $requisition_arr = json_decode($result,true);
       if($requisition_arr['message']=='OK'&&$requisition_arr['code']==0){
           $arr_set = [];
           foreach ($requisition_arr['list'] as $key=>$value){
                   $arr = [] ;
                   $arr[] = $value['id'];
                   $arr[] = $value['columns']['trandate'];
                   $arr[] = $value['columns']['tranid'];
                   $arr[] = $value['columns']['entity']['name'];
                   $sql = "select count(*) as num from requisition_list where internal_id = '$value[id]'";
                   $is_has = Yii::$app->db->createCommand($sql)->queryOne();
                   if($is_has['num']){continue;}
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
           if(isset($arr_set)) {
               $response = Yii::$app->db->createCommand()->batchInsert($table, $arr_key, $arr_set)->execute();
               return $response;
           }
       }
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

    /**
     * 获取最新供应商列表
     */
    public function actionGetVendorList(){
        $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=180&deploy=1';
        $result = $this->actionDoCurl($url);
        $resultArr = json_decode($result,true);
        if(!empty($resultArr)){
            $vendorList = [];
            foreach($resultArr as $key=>$value){
               $vendor['internal_id'] = $value['id'];
               $vendor['vendor_code'] = $value['values']['entityid'];
               $vendor['vendor_name'] = $value['values']['companyname'];
               $vendor['datecreated'] = $value['values']['datecreated'];
               $test = Yii::$app->db->createCommand("select count(*) as num  from tb_vendor_list where internal_id=$value[id]")->queryOne();
               if(!empty($test['num'])){
                   $updateRes = VendorList::updateAll([
                       'vendor_code' => $value['values']['entityid'],
                       'vendor_name' => $value['values']['companyname'],
                   ],[
                       'internal_id'=>$value['id'],
                   ]);
                   continue;
               }else{
                   $vendorList[] = $vendor;
               }
            }
            $tbName = 'tb_vendor_list';
            $column = ['internal_id','vendor_code','vendor_name','datecreated'];
            if(isset($vendorList)) {
                $res = Yii::$app->db->createCommand()->batchInsert($tbName, $column, $vendorList)->execute();
                return $res;
            }
        }


    }

    /**
     * @param int $id
     * 获取供应商明细
     */
    public function actionGetVendorDetail($id = 47191){
        $url = "https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=154&deploy=2&recordtype=Vendor&id=".$id;
        $res = $this->actionDoCurl($url);


    }

    public function  actionMultiRequest(){
        //获取 id/
        $sql = "SELECT internal_id FROM tb_vendor_list WHERE internal_id NOT in (SELECT DISTINCT internalid FROM tb_vendor_detail);";
        $idSet = Yii::$app->db->createCommand($sql)->queryAll();
        $ids = array_column($idSet,'internal_id');
        $multiCurl = [];
        $result = [];
        set_time_limit(0);
        $mh = curl_multi_init();
        foreach ($ids as $i=>$id){
            $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=154&deploy=2&recordtype=Vendor&id='.$id;
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
     * 插入tb_vendor_detail表
     *
     */
    public function actionIntoVendorDetail(){
        $tbName = 'tb_vendor_detail';
        $column = ['internalid','supplier_code','supplier_name','contact_qq','contact_tel','contact_name','bill_type'];
        $result = $this->actionMultiRequest();
        $recordArr = [];
        $res = json_decode($result,true);
        if(!empty($res)&&!array_key_exists('error',$res)){
            foreach ($res as $k=>$v){
                $value = json_decode($v,true);
                if(!array_key_exists('error',$value)) {
                    $record['internalid'] = $value['id'];
                    $record['supplier_code'] = $value['fields']['entityid'];
                    $record['supplier_name'] = $value['fields']['companyname'];
                    $record['contact_qq'] = $value['fields']['custentity_qq_number'];
                    $record['contact_tel'] = $value['fields']['phone'];
                    $record['contact_name'] = $value['fields']['custentity_attention'];
                    $record['bill_type'] = $value['fields']['custentity_invoice_type'];
                    $recordArr[] = $record;
                }
            }
        }

            $response = Yii::$app->db->createCommand()->batchInsert($tbName,$column,$recordArr)->execute();
            return $response;

    }

    /**
     * 获取请购未采购明细
     */
    public function  actionGetRequisitionNonPurchase(){
        $url = "https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=184&deploy=1";
        $result = $this->actionDoCurl($url);
        $result_arr = json_decode($result,true);
        $record_set = [];
        foreach ($result_arr as $key =>$value){
            $record['tran_internal_id'] = $value['id'];
            $record['tranid'] = $value['values']['tranid'];
            $record['name'] = $value['values']['employee.altname'];
            $record['amount'] = $value['values']['amount'];
            $record['description'] = $value['values']['memo'];
            $record['item_internal_id'] = $value['values']['item'][0]['value'];
            $record['item_name'] = $value['values']['item'][0]['text'];
            $record['quantity'] = $value['values']['quantity'];
            $record['createdate'] = $value['values']['trandate'];
            //存在更新 不存在插入
            $sql = "select count(*) as num from tb_requisition_non_purchase where tran_internal_id='$value[id]' and item_name = '$record[item_name]'";
            $num = Yii::$app->db->createCommand($sql)->queryOne();
            if ($num['num']){
                continue;
            }
            $record_set[] = $record;
        }
        $table = 'tb_requisition_non_purchase';
        $column = ['tran_internal_id','tranid','name','amount','description','item_internal_id','item_name','quantity','createdate'];
        if(isset($record_set)){
            $response = Yii::$app->db->createCommand()->batchInsert($table,$column,$record_set)->execute();
            return $response;
        }


    }

    /**
     * @return int
     * @throws \yii\db\Exception
     * 获取产品和所属人列表
     */
    public function actionGetNumberedItem(){
        $url = "https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=187&deploy=1";
        $numbered_item = $this->actionDoCurl($url);
        $numbered_arr = json_decode($numbered_item,true);
        $inventory_item = [];
        if(isset($numbered_arr)&&!empty($numbered_arr)){
            foreach ($numbered_arr as $key=>$value){
                $item['sku'] = $value['itemid'];
                $item['property'] = $value['owner'];
                if(strpos($value['owner'],'-') !== false){
                    $item['bargain'] = ltrim(strstr($value['owner'],'-'),'-');
                }else{
                    $item['bargain'] = $value['owner'];
                }
                $sql = "select count(*) as num from tb_lotnumbered_inventory_item where sku= '$value[itemid]'";
                $has = Yii::$app->db->createCommand($sql)->queryOne();
                if($has['num']){
                    $update_sql = "update tb_lotnumbered_inventory_item set property='$item[property]',bargain='$item[bargain]' where sku='$value[sku]'";
                    $update_res = Yii::$app->db->createCommand($update_sql)->execute();
                }else{
                    $inventory_item[] = $item;
                }

            }
        }

        $table = 'tb_lotnumbered_inventory_item';
        $column = ['sku','property','bargain'];
        $result = Yii::$app->db->createCommand()->batchInsert($table,$column,$inventory_item)->execute();
        return $result;

    }



}
