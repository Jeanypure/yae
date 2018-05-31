<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use backend\models\Company;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'','','');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->brocast_status = 0;
            $model->complete_status = '待完成';
            $model->creator = Yii::$app->user->identity->username;
            $model->save();
            return $this->redirect(['view', 'id' => $model->product_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(empty($model->creator)){
                $model->creator = Yii::$app->user->identity->username;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    /**
     * This is to show reject lists
     */
    public function  actionReject()
    {
        $searchModel = new ProductSearch();

        $res = Company::find()->select('id,sub_company')
            ->where("leader_id=".Yii::$app->user->identity->getId())->asArray()->one();
        $sub_company = $res['sub_company']??'';

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'拒绝',$sub_company,'');

        return $this->render('reject_lists', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


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
            update `product` set `is_submit`= 1 where `product_id` in ($ids_str)
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
            update `product` set `is_submit`= 0 where `product_id` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }


    }




}
