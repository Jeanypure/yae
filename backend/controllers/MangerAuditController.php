<?php

namespace backend\controllers;

use backend\models\Preview;
use Yii;
use backend\models\PurInfo;
use backend\models\MangerAuditSearch;
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'待评审');
        $models = $dataProvider->getModels();
        $ids = array_column($models,'product_id');
        $dataProvider->setKeys($ids);

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
//      var_dump($preview[0]);die;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'preview' => $preview[0]
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
                $model->preview_status = '已评审';
                $model->save(false);
                return $this->redirect(['index']);
            }

            return $this->renderAjax('update_audit', [
                'model' => $model,
            ]);
        }




    }


}
