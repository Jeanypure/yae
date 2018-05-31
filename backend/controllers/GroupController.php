<?php

namespace backend\controllers;

use Codeception\Lib\Generator\Group;
use Yii;
use backend\models\Product;
use backend\models\GroupSearch;
use backend\models\Company;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupController implements the CRUD actions for Product model.
 */
class GroupController extends Controller
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
        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'','','','1');

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        if ($model->load(Yii::$app->request->post()) ) {
            $model->sub_company = Yii::$app->request->post()['Product']['sub_company'];
            $model->sub_company_id = Yii::$app->request->post()['Product']['sub_company'];
            $model->group_mark = Yii::$app->request->post()['Product']['group_mark'];
            $model->group_status = '已分组';
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->product_id]);
        }

        $company = new Company();
        $res =  $company->find()->select('id,sub_company')->asArray()->all();

        foreach ($res as $value) {
            $result[$value['id']]  = $value['sub_company'];
        }
//        var_dump($res);
//        var_dump($result);
//        die;

        return $this->render('update', [
            'model' => $model,
            'data' => $result
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

    /**To Brocast the Product model based on its primary key value.
     * mark the status brocasting
     */

    public function actionBrocast()
    {
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');
        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `product` set `brocast_status`= 1  where `product_id` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }


    }

    /**
     * To end brocast the Product based on its primary key value
     * @throws NotFoundHttpException
     */
    public function actionEndBrocast()
    {
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');
        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `product` set `brocast_status`= 2 where `product_id` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }
    }

}
