<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\GroupPurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupPurController implements the CRUD actions for PurInfo model.
 */
class GroupPurController extends Controller
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
        $searchModel = new GroupPurSearch();
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
        $rate = $this->actionExchangeRate();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'exchange_rate' => $rate

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
        $rate = $this->actionExchangeRate();
        $post = Yii::$app->request->post();
        if ($model->load($post) ) {
            if($model->brocast_status == 2){ //如果结束公示在更新部门 同步更新评审表的member2
                try{
                $pur_group = Yii::$app->request->post()['PurInfo']['pur_group'];
                $result  =   Yii::$app->db->createCommand("
                 update `preview` set `member2`= (select leader from company where sub_company= $pur_group)
                 where `product_id`=$id   and   `member2`  in (select leader from company )
                ")->execute();

                }catch(Exception $e){
                    throw new Exception();
                }

            }
            $model->pur_group = implode(',',$post['PurInfo']['pur_group']);
            $model->save(false);
            return $this->redirect(['index']);
        }
        if(!empty($model->pur_group)){
            $model->pur_group = explode(',',$model->pur_group);
        }
        return $this->render('update', [
            'model' => $model,
            'exchange_rate' => $rate
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


    /**
     * Find exchange rate
     * @return mixed
     * @throws \yii\db\Exception
     */
    public  function actionExchangeRate(){
        $res = Yii::$app->db->createCommand("
        select t1.`exchange_rate` from `yae_exchange_rate`  t1 where t1.`currency`='USD'
        ")->queryOne();
        $rate = $res['exchange_rate'];
        return $rate;
    }



    /**To Brocast the Product model based on its primary key value.
     * mark the status brocasting
     */

    public function actionBrocast()
    {
        $ids = $_POST['id'];
        $val='';
        $id_set='';
        if($ids){
            foreach ($_POST['id'] as $key=>$value){
                  $val.=$value.',';
            }
            $id_set = trim($val,',');
            Yii::$app->db->createCommand("
                update `pur_info` set `brocast_status` = 1,`preview_status`= 0  WHERE `pur_info_id` in ($id_set)
            ")->execute();
            echo '公示产品成功';
        }else{
            echo '请选择公示产品!';

        }
    }

    /**
     * To end brocast the Product based on its primary key value
     * @throws NotFoundHttpException
     * 结束公示之后要把部门的产品 同步到preview表中
     */
    public function actionEndBrocast()
    {
        $ids = $_POST['id'];

        $val = '';
        if($ids){
            foreach ($_POST['id'] as $key=>$value){
                $val.=$value.',';
            }

            $id_set = trim($val,',');


            $preview_result = $this->actionPreview($id_set); // 更新同步评审表的一系列操作

            $pur_result  = Yii::$app->db->createCommand("
                update `pur_info` set `brocast_status` = 2 ,`preview_status`= 0 WHERE `pur_info_id` in ($id_set)
            ")->execute();

            echo '产品公示结束!';

        }
        else{
            echo '请选择产品!';

        }
    }


// 同部更新到评审表中

    public function actionPreview($id_set=null){
        $id_set = 2848;
        $lead = Yii::$app->db->createCommand("select DISTINCT sub_company,leader FROM company ;")->queryAll();
        $leader ='';
        $new_leader = [];
        foreach ($lead as $k=>$v){
            $leader.= "'".$v['leader']."',";
            $new_leader[$v['sub_company']] = $v['leader'];
        }

        $leaders = rtrim($leader,",");

        $count_num = Yii::$app->db->createCommand("
            select count(*) as number from `preview` where 
            `product_id` in ($id_set) 
            and `member2` in ( $leaders)
            ")->queryOne();


        if($count_num['number'] > 0){ //update
            // 根据条件在leaders里 更新现在的

            $new_items = Yii::$app->db->createCommand("
                SELECT leader,pur_info_id FROM pur_info o
        LEFT JOIN company y ON y.sub_company=o.pur_group
        WHERE pur_info_id in ($id_set);
        ")->queryAll();

            foreach ($new_items as $key=>$value){
                try{
                    $result  =   Yii::$app->db->createCommand("
                update `preview` set `member2`='$value[leader]',`audit_role`=1 where `product_id`=$value[pur_info_id] 
                and `member2`  in ( $leaders)
                ")->execute();

                }catch(Exception $e){
                    throw new Exception();
                }


            }
        }
        else{//insert
            //按部门分开 逐条分开插入
            $id_arr = explode(',',$id_set);
            foreach($id_arr  as $k => $v ){
                $model = $this->findModel($v);
                $group_arr = explode(',',$model->pur_group);
                $arr[] = [$new_leader[$group_arr[0]],$v,1];
                $arr[] = [$new_leader[$group_arr[1]],$v,1];
            }
            $table = 'preview';
            $arr_key = ['member2','product_id','audit_role'];
            $res = Yii::$app->db->createCommand()->batchInsert($table,$arr_key,$arr)->execute();
//TODO 单部门和多部门混合情况的处理
        }

        return $res;

    }




}
