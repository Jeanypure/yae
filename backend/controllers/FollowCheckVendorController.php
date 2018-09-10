<?php

namespace backend\controllers;

use Yii;
use backend\models\YaeSupplier;
use backend\models\FollowCheckVendorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SupplierContact;

/**
 * FollowCheckVendorController implements the CRUD actions for YaeSupplier model.
 */
class FollowCheckVendorController extends Controller
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
     * Lists all YaeSupplier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FollowCheckVendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single YaeSupplier model.
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
     * Updates an existing YaeSupplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $supplier = $this->findModel($id);
        $supplier_contact = SupplierContact::find()->where(['supplier_id'=>$id])->one();
        $update_date = date('Y-m-d H:i:s');
        if ($supplier->load(Yii::$app->request->post())&&$supplier_contact->load(Yii::$app->request->post())) {
            $supplier->update_date = $update_date;
            $supplier->save(false);
            $supplier_contact->save(false);
            return $this->redirect(['view', 'id' => $supplier->id]);
        }

        return $this->render('update', [
            'model' => $supplier,
            'supplier_contact' => $supplier_contact,
        ]);
    }



    /**
     * Finds the YaeSupplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return YaeSupplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = YaeSupplier::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
