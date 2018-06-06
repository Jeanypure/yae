<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\AuditSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Preview;
use backend\models\Company;


/**
 * AuditController implements the CRUD actions for PurInfo model.
 */
class AuditController extends Controller
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
        $searchModel = new AuditSearch();
        $res = Company::find()->select('id,sub_company')
            ->where("leader_id=".Yii::$app->user->identity->getId())->asArray()->one();
        $sub_id = $res['id']??'';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$sub_id);

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
        $exchange_rate = PurInfoController::actionExchangeRate();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'exchange_rate' =>$exchange_rate

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

        if(($model_preview = Preview::findOne(['product_id'=>$id,
            'member2'=>Yii::$app->user->identity->username])))
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
            $model_preview =  new Preview();
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
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');
        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
           --  update `pur_info` set `is_submit_manager`= 1  where `pur_info_id` in ($ids_str);
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
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');
        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
           -- update `pur_info` set `is_submit_manager`= 0  where `pur_info_id` in ($ids_str);
            update `preview` set `submit_manager`= 0  where `product_id` in ($ids_str) and  member2='$username';

            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }
    }

}
