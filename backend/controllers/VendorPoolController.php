<?php

namespace backend\controllers;

use Yii;
use backend\models\VendorPool;
use backend\models\VendorPoolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VendorPoolController implements the CRUD actions for VendorPool model.
 */
class VendorPoolController extends Controller
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
     * @return string
     * @throws \yii\db\Exception
     * 按供应商名字搜对应的编码
     * 不能看到所有供应商列表
     */
    public function actionIndex()
    {
        $model = new VendorPool();
        if(Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $name = $post['supplier_name'];
            if (!empty($name) && isset($name)) {
                $sql = "select supplier_code,supplier_name from vendor_pool where supplier_name like '%" . $name . "%'";
                $ret = Yii::$app->db->createCommand($sql)->queryAll();
                if(empty($ret)){
                    return 'empty!';
                }
                return  json_encode($ret,true);
            }
        }else{
            return $this->render('suppliername', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Displays a single VendorPool model.
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
     * Creates a new VendorPool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VendorPool();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VendorPool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VendorPool model.
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
     * Finds the VendorPool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VendorPool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VendorPool::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }






}
