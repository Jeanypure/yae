<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\Sample;
use backend\models\Goodssku;
use backend\models\MinisterAgreestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MinisterAgreestController implements the CRUD actions for PurInfo model.
 */
class MinisterAgreestController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PurInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MinisterAgreestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionView($id)
    {
        $sample_model = Sample::findOne(['spur_info_id'=>$id]);
        $submit2_at = date('Y-m-d H:i:s');
        $post = Yii::$app->request->post();
        if(isset($sample_model)&&!empty($sample_model)){
            if($sample_model->load($post) ){
               $is_agree =  $post['Sample']['is_agreest'];
                if((int)$is_agree==1){
                    $res = Yii::$app->db->createCommand("
                        update `pur_info` set `sample_submit2`= 1 ,`submit2_at` = '$submit2_at'
                        where `pur_info_id` = $id
                        ")->execute();
                    $sample_model->is_agreest=1;
                 }

                 $sample_model->save(false);
                 return $this->redirect(['index']);

             }
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
                'sample_model' => $sample_model,
            ]);
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

    }
    /**
     * Finds the PurInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    /**
     * Commit product
     * @throws \yii\db\Exception
     *
     */
    public function actionCommit()
    {
        $ids = $_POST['id'];
        $submit2_at = date('Y-m-d H:i:s');

        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        if(isset($ids_str)&&!empty($ids_str)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `sample_submit2`= 1 ,`submit2_at` = '$submit2_at'
            where `pur_info_id` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }



    }

    /**
     * Cancel commit product
     * @throws \yii\db\Exception
     */
    public function actionCancel()
    {
        $ids = $_POST['id'];
        $cancel_at = date('Y-m-d H:i:s');

        if(is_string($_POST['id'])){
            $ids = [];
            $ids[] = $_POST['id'];
        }
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        if(isset($ids_str)&&!empty($ids_str)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `sample_submit2`= 0 ,`cancel2_at` = '$cancel_at'
            where `pur_info_id` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }


    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     * 确定采购, 1入区组长表   2 入产品档案表goodssku  4 sku_vendor
     *  3 若 source=0 更新樣品表 minister_result=3 推送產品
     */

    public function actionQuality($id)
    {
        $model = $this->findModel($id);
        $sample_model = Sample::findOne(['spur_info_id'=>$id]);
        $post = Yii::$app->request->post();

        if($model->load($post)){
            $model->attributes = $post['PurInfo'];
            $sample_model->attributes = $post['Sample'];
            $minister_result = $post['Sample']['minister_result'];
            if(isset($post['PurInfo']['is_purchase'])&&$post['PurInfo']['is_purchase']==1){
                $model->sure_purchase_time = date('Y-m-d H:i:s');
                    try{
                        $sql = " SET @id = $id;
                            CALL purinfo_to_goodssku (@id);";
                        $res = Yii::$app->db->createCommand($sql)->execute();

                    }catch(\Exception $exception){
                        throw $exception;
                    }
                    $goodsSkuHsele = Yii::$app->db->createCommand("select count(*) as number_record from goodssku where pur_info_id = $id")->queryOne();
                    if(!empty($goodsSkuHsele['number_record'])){
                        $hs_res =  $this->actionUpdateHs($id,$model->hs_code);
                    }
                   if($model->source == 0){
                        try{
                            Yii::$app->db->createCommand("
                        update sample set minister_result=3, audit_team_result=3,purchaser_result=3 where spur_info_id=$id;
                    ")->execute();
                        }catch(\Exception  $exception){
                            throw $exception;
                        }

                    }else{
                        if((int)$minister_result==$sample_model->purchaser_result){
                            $sample_model->audit_team_result = $minister_result;
                            $sample_model->is_diff = 0;

                        }else{
                            $sample_model->is_diff = 1;
                        }

                    }

                    $count = Yii::$app->db->createCommand("
                            select count(*) as num from headman where product_id=$id
                            ")->queryOne();

                    if(empty($count['num'])){ //第一次 插入
                        $this->actionToHeadman($id);
                    }

            }

            if ($sample_model->save(false)&&$model->save(false)) {
                Yii::$app->getSession()->setFlash('success', '保存成功');
            } else {
                Yii::$app->getSession()->setFlash('error', '保存失败');
            }
            return $this->redirect(['index']);
        }
        return  $this->renderAjax('is_quality', [
            'model' => $model,
            'sample_model' => $sample_model,
        ]);

    }

    /**
     * @param $id
     * @return int
     * @throws \yii\db\Exception
     * 插入到组长评审表中
     */
        public  function actionToHeadman($id){

           $group =  Yii::$app->db->createCommand("
                select pur_group from pur_info where  pur_info_id = $id
            ")->queryOne();

            $no_site = Yii::$app->db->createCommand("
                select no_site from company where  id= $group[pur_group]
            ")->queryOne();

            $site_arr = explode(',',$no_site['no_site']);
            $site_str = '';
            foreach ($site_arr as $key=>$val){
                $site_str .= "'".$val."',";
            }


            $str_site = trim($site_str,',');


            $men_site = Yii::$app->db->createCommand("
                select  code as purchaser,$id as id,purchaser as site from purchaser where  purchaser in($str_site)
            ")->queryAll();


            foreach ($men_site as $key=>$value){
                $arr[] =  array_values($value);
            }


            $table = 'headman';
            $arr_key = ['headman','product_id','site'];

            $res = $this->actionMultArray2Insert($table,$arr_key, $arr, $split = '`');
            try{
                $result =   Yii::$app->db->createCommand("$res")->execute();

            }
            catch(Exception $e){
                throw new Exception();
            }

//            return $result;



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

    /**
     * @param $id
     * @param $hs_code
     * @return string
     * @throws \yii\db\Exception
     * @memo update goodssku declaration elements key
     */

        public function  actionUpdateHs($id,$hs_code){
            $goodssku = Goodssku::findOne(['pur_info_id'=>$id]);
            $hs_code_sql = "select declaration_elements  from hs_code where  hs_code= '$hs_code'";
            $hs_arr =  Yii::$app->db->createCommand($hs_code_sql)->queryOne();
            $hs_code_arr =  explode(',',$hs_arr['declaration_elements']);
            $column_key = ['declaration_item_key1','declaration_item_key2','declaration_item_key3','declaration_item_key4',
                'declaration_item_key5','declaration_item_key6','declaration_item_key7','declaration_item_key8','declaration_item_key9'];
            if(!empty($hs_code_arr )){
                foreach ($hs_code_arr as $key=>$value){
                    $attri = $column_key[$key];
                    $goodssku->$attri = preg_replace('/\d+\:/','',$value);
                }
                if($goodssku->save(false)){
                    return 'ok';
                }
            }
            return 'not found'.$hs_code;



        }
}
