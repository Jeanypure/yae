<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\AssignTaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * assignTaskController implements the CRUD actions for PurInfo model.
 */
class AssignTaskController extends Controller
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
        $searchModel = new AssignTaskSearch();
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PurInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PurInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PurInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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



    public  function actionTask(){
        $ids = $_POST['id'];
        Yii::$app->session['ids']=$ids;
        echo '选择了'.count($ids).'个产品请分配!';
    }

    public function actionPickMember()
    {
        $audit_member = Yii::$app->db->createCommand("
                            SELECT p.`purchaser` from `purchaser` p  WHERE  p.`role` =1
                         ")->queryAll();

        $model = new PurInfo();

        if ($model->load(Yii::$app->request->post()) ) {
           $member = Yii::$app->request->post()["PurInfo"]["member"];
           $pur_info_ids =  Yii::$app->session['ids'];
           $pur_ids = '';
           foreach ($pur_info_ids as $key=>$value){
               $pur_ids.=$value.',';

           }
           $ids_str = rtrim($pur_ids,',');
            try{
                $result =   Yii::$app->db->createCommand(" 
                            update `pur_info` set `member`= '$member' where pur_info_id in ($ids_str);
                         ")->execute();
            }
            catch(Exception $e){
                throw new Exception();
            }

            $table = 'preview';
            $arr_key = ['member2','product_id'];
            $member2 = [$member];
            $arr = [];
            foreach ($pur_info_ids as $key=>$value){
                $val = [$value];
                $new_array = array_merge($member2,$val);
                $arr[] = $new_array;

            }

            $res = $this->actionMultArray2Insert($table,$arr_key, $arr, $split = '`');

            $count_num = Yii::$app->db->createCommand("
            select count(*) as number from `preview` where `product_id` in ($ids_str) 
            and `member2` in ( SELECT p.`purchaser` from `purchaser` p  WHERE  p.`role` =1)
            
            ")->queryOne();

            if($count_num['number']!= 0){ //更新原来的member2

                try{//分配的同时 preview无此产品 插入  存在则更新preview表
                    $update_member2 = Yii::$app->db->createCommand("
                    update `preview` set `member2`= '$member' where `product_id` in ($ids_str);
                    update `pur_info` set `member`= '$member' where pur_info_id in ($ids_str);
                    ")->execute();
                }
                catch(Exception $e){
                    throw new Exception();
                }
            }else{//插入新记录
                try{//分配的同时 preview无此产品 插入  存在则更新preview表
                    $into_preview = Yii::$app->db->createCommand("$res")->execute();
                }
                catch(Exception $e){
                    throw new Exception();
                }
            }





          if(empty($result)){
              unset(Yii::$app->session['ids']);
          }

            return $this->redirect(['index']);
        }

        $mem=[];
        foreach($audit_member as $k=>$v){
            $mem[$v['purchaser']] = $v['purchaser'];

        }
        return $this->renderAjax('pick_member', [
            'model' => $model,
            'member'=>$mem
        ]);




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
