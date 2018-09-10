<?php

namespace backend\controllers;

use backend\models\FollowCheckProductSearch;
use Yii;
use backend\models\Goodssku;
use backend\models\FollowCheckProduct;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SkuVendor;

/**
 * FollowCheckProductController implements the CRUD actions for Goodssku model.
 */
class FollowCheckProductController extends Controller
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
     * Lists all Goodssku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FollowCheckProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goodssku model.
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
     * Creates a new Goodssku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goodssku();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sku_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goodssku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $goodssku = $this->findModel($id);
        $sku_vendor = SkuVendor::find()->where(['sku_id'=>$id])->one();
        $goodssku->sale_company = explode(',',$goodssku->sale_company); //ActiveForm 指定已存的销售公司
        $post = Yii::$app->request->post();
        if(isset($post['Goodssku'])&&isset($post['SkuVendor'])){
            $goodssku->attributes=$post['Goodssku'];
            $sku_vendor->attributes=$post['SkuVendor'];
            $goodssku->sale_company = implode(",", $post['Goodssku']['sale_company']);
            $goodssku->vendor_code = $post['SkuVendor']['vendor_code'];
            $goodssku->save(false);
            $sku_vendor->save(false);
            return $this->redirect(['index']);
        }



        return $this->render('update', [
            'model' => $goodssku,
            'sku_vendor' => $sku_vendor
        ]);
    }

    /**
     * Deletes an existing Goodssku model.
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
     * Finds the Goodssku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goodssku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goodssku::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
