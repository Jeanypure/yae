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

        if(($model = Preview::findOne(['product_id'=>$id,
            'member_id'=>Yii::$app->user->identity->getId()])))
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect('index');
            }
            return $this->renderAjax('update_audit', [
                'model' => $model,
            ]);

        }else {
          $model =  new Preview();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect('index');

            }
            return  $this->renderAjax('create_audit', [
                'model' => $model,
                'id' =>$id,
            ]);
        }


    }


}
