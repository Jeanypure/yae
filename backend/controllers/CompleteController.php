<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use app\models\CompleteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use backend\controllers\PurInfoController;


/**
 * CompleteController implements the CRUD actions for PurInfo model.
 */
class CompleteController extends Controller
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
        $searchModel = new CompleteSearch();

        $username = Yii::$app->user->getIdentity()->username;
        if($username=='admin'||$username=='Jenny'){
            $username ='';
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$username,'0');

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
        $rate = PurInfoController::actionExchangeRate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

    public function  actionAccept()
    {
        $ids = $_POST['id'];
        $pur_ids='';
        foreach ($ids as $key=>$value){
            $pur_ids.=$value.',';
        }
        $ids_str = rtrim($pur_ids,',');
        if($ids_str){
            $result =   Yii::$app->db->createCommand(" 
                            update `pur_info` set `preview_status`= '接受' where pur_info_id in ($ids_str)
                         ")->execute();
            if($result){
                echo '接受此产品!';
            }

        }
        else{
            echo '请选择产品!';

        }

    }
    public function  actionReject()
    {
        $ids = $_POST['id'];
        $pur_ids='';
        foreach ($ids as $key=>$value){
            $pur_ids.=$value.',';
        }
        $ids_str = rtrim($pur_ids,',');
        if($ids_str){
            $result =   Yii::$app->db->createCommand(" 
                            update `pur_info` set `preview_status`= '拒绝' where pur_info_id in ($ids_str)
                         ")->execute();

            if($result){
                echo '拒绝此产品!';
            }
        }
        else{
            echo '请选择产品!';

        }

    }
}
