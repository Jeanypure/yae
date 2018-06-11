<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\MangerAuditSearch;
use backend\models\Preview;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * MangerAuditController implements the CRUD actions for PurInfo model.
 */
class MangerAuditController extends Controller
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
        $searchModel = new MangerAuditSearch();
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

       $preview =   Preview::find()->where(['product_id'=>$id])->all();
       $num = sizeof($preview);
       $model_update = $this->findModel($id);
       $exchange_rate = PurInfoController::actionExchangeRate();


        if($num > 1){
          if ($model_update->load(Yii::$app->request->post()) ) {
              //采样状态 入采样流程
              if(Yii::$app->request->post()['PurInfo']['master_result']==1 ){
                  Yii::$app->db->createCommand("
                    INSERT INTO `sample`  (spur_info_id) value ($id)
                  ")->execute();
              }

              $model_update->preview_status = 1;
              $model_update->save(false);

              return $this->redirect(['index']);
          }
          return $this->render('view', [
              'model' => $this->findModel($id),
              'preview' => $preview[0],
              'preview2' => $preview[1],
              'num' =>$num,
              'model_update' =>$model_update,
              'exchange_rate' =>$exchange_rate,



          ]);
      }elseif($num ==1){
          if ($model_update->load(Yii::$app->request->post())) {
              //采样状态 入采样流程
              if(Yii::$app->request->post()['PurInfo']['master_result']==1 ){
                  Yii::$app->db->createCommand("
                    INSERT INTO `sample`  (spur_info_id) value ($id)
                  ")->execute();
              }
              $model_update->preview_status = 1;
              $model_update->save(false);
              return $this->redirect(['index']);

          }

          return $this->render('view', [
              'model' => $this->findModel($id),
              'num' =>$num,
              'preview' => $preview[0],
              'model_update' =>$model_update,
              'exchange_rate' =>$exchange_rate,


          ]);

      }
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
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
     * Manger Audit is the  final determination  what the product status
     */
    public function actionAudit( $id )
    {
        $model = $this->findModel($id);
        if($model){
            if ($model->load(Yii::$app->request->post())  ) {
                $model->master_result = Yii::$app->request->post()['PurInfo']['master_result'];
                $model->master_mark = Yii::$app->request->post()['PurInfo']['master_mark'];
                $model->master_member = Yii::$app->user->identity->username;
                $model->preview_status = 1;
                $model->save(false);
                return $this->redirect(['index']);
            }

            return $this->renderAjax('update_audit', [
                'model' => $model,
            ]);
        }




    }


}
