<?php

namespace backend\controllers;

use backend\models\Sample;
use Yii;
use backend\models\PurInfo;
use backend\models\PurInfoTrackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurInfoTrackController implements the CRUD actions for PurInfo model.
 */
class PurInfoTrackController extends Controller
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
        $searchModel = new PurInfoTrackSearch();
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
        $sample_model = Sample::findOne(['spur_info_id'=>$id]);

        if ($sample_model->load(Yii::$app->request->post())) {
            //部长对产品的等级判断是否和采购一致 若一致则更新审核组
            $purchaser_result = Yii::$app->request->post()['Sample']['purchaser_result'];
            if((int)$purchaser_result==$sample_model->minister_result){
                $sample_model->audit_team_result = $purchaser_result;
                $sample_model->is_diff = 0;

            }else{
                $sample_model->is_diff = 1;
            }
            $sample_model->save();
            return $this->redirect(['update', 'id' => $sample_model->spur_info_id]);
        }




        return $this->render('update', [
            'model' => $model,
            'sample_model' => $sample_model,
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
     *
     */
    public function actionCommit()
    {
        $ids = $_POST['id'];
        $submit1_at = date('Y-m-d H:i:s');
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        if(isset($ids_str)&&!empty($ids_str)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `sample_submit1`= 1,`submit1_at` = '$submit1_at'
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
            update `pur_info` set `sample_submit1`= 0 ,`cancel1_at` = '$cancel_at'
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
     * 单个提交
     */

    public function actionSingleCommit()
    {
        $ids = $_POST['id'];
        $submit1_at = date('Y-m-d H:i:s');
        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `sample_submit1`= 1 ,`submit1_at` = '$submit1_at'
            where `pur_info_id` in ($ids)
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
    public function actionSingleCancel()
    {
        $ids = $_POST['id'];
        $cancel_at = date('Y-m-d H:i:s');
        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `sample_submit1`= 0 ,`cancel1_at` = '$cancel_at'
            where `pur_info_id` in ($ids)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }



    }

}
