<?php

namespace backend\controllers;

use backend\models\Headman;
use Yii;
use backend\models\PurInfo;
use backend\models\HeadManSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HeadManController implements the CRUD actions for PurInfo model.
 */
class HeadManController extends Controller
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
        $searchModel = new HeadManSearch();
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


    /**
     * Create audit
     * @param $id
     * @return string|\yii\web\Response
     */

    public function actionCreateAudit($id)
    {

        $exchange_rate = PurInfoController::actionExchangeRate();

        $purinfo = $this->findModel($id);
        $model_preview = Headman::findOne(['product_id'=>$id,
            'headman'=>Yii::$app->user->identity->username]);


        if($model_preview)
        { // 审核组 更新评审
            if ($model_preview->load(Yii::$app->request->post()) ) {

                $model_preview->view_status = 1;
                $model_preview->save(false);
                return $this->redirect('index');
            }
            return $this->renderAjax('update_audit', [
                'model_preview' => $model_preview,
                'purinfo'=>$purinfo,
                'exchange_rate' =>$exchange_rate


            ]);

        }else {
            $model_preview =  new Headman();
            if ($model_preview->load(Yii::$app->request->post())) {
                $model_preview->view_status = 1;
                $model_preview->save(false);
                return $this->redirect('index');

            }
            return  $this->renderAjax('create_audit', [
                'model_preview' => $model_preview,
                'id' =>$id,
                'purinfo'=>$purinfo,
                'exchange_rate' =>$exchange_rate
            ]);
        }


    }

    public  function  actionSubmit(){

        $username = Yii::$app->user->identity->username;
        $tag = 1;
        $ids = $_POST['id'];

        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');
        $result = $this->actionAuditStatus($username,$ids_str,$tag);

        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
         
            update `preview` set `submit_manager`= 1  where `product_id` in ($ids_str) and  member2='$username' ;
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }
    }


    public  function  actionCancel(){
        $username = Yii::$app->user->identity->username;
        $tag = 0;
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        $result = $this->actionAuditStatus($username,$ids_str,$tag);


        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `preview` set `submit_manager`= 0  where `product_id` in ($ids_str) and  member2='$username';
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }
    }

    /**
     * @param $username
     * @param $ids_str
     * @param $tag
     * @return int
     * @throws \yii\db\Exception
     *审核组更新audit_a     部长组更新audit_b
     */

    public function actionAuditStatus($username,$ids_str,$tag){


        $arr_role =  Yii::$app->db->createCommand("
        SELECT  role FROM purchaser WHERE purchaser='$username'
        ")->queryOne();
        if($arr_role['role']==1){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `audit_a`= $tag where `pur_info_id` in ($ids_str);
            ")->execute();

        }elseif($arr_role['role']==2){
            $res = Yii::$app->db->createCommand("
            update `pur_info` set `audit_b`= $tag where `pur_info_id` in ($ids_str);
            ")->execute();
        }
        return $res;
    }
}
