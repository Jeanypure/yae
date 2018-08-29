<?php

namespace backend\controllers;

use Yii;
use backend\models\YaeSupplier;
use backend\models\YaeSupplierSearch;
use backend\models\SupplierContact;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * YaeSupplierController implements the CRUD actions for YaeSupplier model.
 */
class YaeSupplierController extends Controller
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
        $searchModel = new YaeSupplierSearch();
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
     * Creates a new YaeSupplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $supplier = new YaeSupplier();
        $supplier_contact = new SupplierContact();
        $username = Yii::$app->user->identity->username;
        $post = Yii::$app->request->post();
        if (isset($post['YaeSupplier']) && isset($post['SupplierContact'])){
            $supplier->attributes = $post['YaeSupplier'];
            $supplier->submitter = $username;
            $supplier->save(false);

            $supplier_contact->username = $username;
            $supplier_contact->supplier_id = $supplier->primaryKey ;
            $supplier_contact->attributes=$post['SupplierContact'];
            $supplier_contact->save(false);
            return $this->redirect(['view', 'id' => $supplier->id]);

        }


        return $this->render('create', [
            'supplier' => $supplier,
            'supplier_contact' => $supplier_contact,
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
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
            update `yae_supplier` set `is_submit_vendor`= 1 where `id` in ($ids_str)
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
             update `yae_supplier` set `is_submit_vendor`= 0 where `id` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }


    }


    public function actionAddContact($id){
        $model = new SupplierContact();
        $username = Yii::$app->user->identity->username;

        $supplier_model =  SupplierContact::find()
                        ->where(['supplier_id'=>$id,'username'=>$username])
                        ->one();

        if(isset($supplier_model)){  //更新

            if ($supplier_model->load(Yii::$app->request->post())&& $supplier_model->save() ) {
                return $this->redirect(['index']);
            }

            return $this->renderAjax('contact_create', [
                'model' => $supplier_model,
            ]);
        }else{            //创建
            if ($model->load(Yii::$app->request->post()) ) {
                $model->username = $username;
                $model->supplier_id = $id ;
                $model->save();
                return $this->redirect(['index']);
            }

            return $this->renderAjax('contact_create', [
                'model' => $model,
            ]);
        }

    }

}
