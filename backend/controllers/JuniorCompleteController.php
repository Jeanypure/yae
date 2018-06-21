<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\JuniorCompleteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JuniorCompleteController implements the CRUD actions for PurInfo model.
 */
class JuniorCompleteController extends Controller
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
        $searchModel = new JuniorCompleteSearch();
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
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
        $rate = PurInfoController::actionExchangeRate();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
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
     * Commit product
     * @throws \yii\db\Exception
     */
    public function actionCommit()
    {
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `junior_submit`= 1 where `pur_info_id` in ($ids_str)
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
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `junior_submit`= 0 where `pur_info_id` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }


    }



    /**
     * Mark completed
     */
    public function  actionCompleted(){

        $ids = $_POST['id'];



        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');


        $parent_id_res = Yii::$app->db->createCommand("
        SELECT parent_product_id FROM pur_info where pur_info_id in ($ids_str)
        ")->queryAll();
        $parent_ids = '';
        foreach ($parent_id_res as $k=>$v){
            $parent_ids.= $v['parent_product_id'].',';

        }
        $partent_ids_str = trim($parent_ids,',');


        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `pur_complete_status`= 1 where `pur_info_id` in ($ids_str);
            update `product` set `complete_status`= 1 where `product_id` in ($partent_ids_str);
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }
    }


    /**
     * Mark cancel
     *
     */

    public function  actionUnCompleted(){
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');


        $parent_id_res = Yii::$app->db->createCommand("
        SELECT parent_product_id FROM pur_info where pur_info_id in ($ids_str)
        ")->queryAll();
        $parent_ids = '';
        foreach ($parent_id_res as $k=>$v){
            $parent_ids.= $v['parent_product_id'].',';

        }
        $partent_ids_str = trim($parent_ids,',');


        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `pur_complete_status`= 0 where `pur_info_id` in ($ids_str);
            update `product` set `complete_status`= 0  where `product_id` in ($partent_ids_str);
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }
    }

    /**
     * @throws \yii\db\Exception
     */

    public function  actionAssessment(){
        $id = $_POST['id'];
        $res =  Yii::$app->db->createCommand("
            update pur_info set audit_a=0,audit_b=0,preview_status=0 where pur_info_id=$id;
            update preview  set view_status = 0, submit_manager = 0 where product_id=$id;
        ")->execute();

        if($res){
            echo 'success';
        }
    }

}
