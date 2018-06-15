<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\Sample;
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
     * Displays a single PurInfo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $sample_model = Sample::findOne(['spur_info_id'=>$id]);
        if(isset($sample_model)&&!empty($sample_model)){
             if($sample_model->load(Yii::$app->request->post())&& $sample_model->save()){
                 return $this->redirect(['index']);

             }
            return $this->render('view', [
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


    public function actionQuality($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
            $model->is_quality = Yii::$app->request->post()['PurInfo']['is_quality'];
            $model->is_purchase = Yii::$app->request->post()['PurInfo']['is_purchase'];

            if(Yii::$app->request->post()['PurInfo']['is_purchase']==1){// 确定采购, 入区组长表
                $count = Yii::$app->db->createCommand("
                select count(*) as num from headman where product_id=$id
                ")->queryOne();
                if(empty($count['num'])){ //第一次 插入
                    $this->actionToHeadman($id);
                }
            }

            $model->save(false);
            return $this->redirect('index');
        }
        return  $this->renderAjax('is_quality', [
            'model' => $model,
        ]);

    }

        public function actionShare($id){

            $model = $this->findModel($id);

            return  $this->renderAjax('share', [
                'model' => $model,
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
