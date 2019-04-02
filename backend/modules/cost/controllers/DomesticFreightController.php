<?php

namespace backend\modules\cost\controllers;

use Yii;
use backend\modules\cost\models\DomesticFreight;
use backend\modules\cost\models\DomesticFreightSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DomesticFreightController implements the CRUD actions for DomesticFreight model.
 */
class DomesticFreightController extends Controller
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
     * Lists all DomesticFreight models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DomesticFreightSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DomesticFreight model.
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
     * Creates a new DomesticFreight model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pid=0,$typeid=1)
    {
        $pid = (int)Yii::$app->request->get('pid');
        $typeid = (int)Yii::$app->request->get('typeid');
        $model = new DomesticFreight();
        $model->getSonList($pid);
        if($typeid == 1){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->getSonList($pid);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->dfid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DomesticFreight model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->dfid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DomesticFreight model.
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
     * Finds the DomesticFreight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DomesticFreight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DomesticFreight::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return string
     * @description 经理助理审核
     */
    public function actionCheckedFreight(){
        $searchModel = new DomesticFreightSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('checked', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @description 单个 标记已审核
     */
    public  function actionChecked($id){
        $frightRecord = $this->findModel($id);
        $frightRecord->has_checked = 1;
        $frightRecord->auditor = Yii::$app->user->identity->username;
        $frightRecord->checked_time = date('Y-m-d H:i:s');
        $frightRecord->save();
        return $this->redirect(['checked-freight']);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @description 单个 取消标记
     */

    public  function actionUnChecked($id){
        $frightRecord = $this->findModel($id);
        $frightRecord->has_checked = 0;
        $frightRecord->checked_time = date('Y-m-d H:i:s');
        $frightRecord->save();
        return $this->redirect(['checked-freight']);
    }

    /**
     * @description 批量标记审核 则批量更新已标记
     */
    public function actionMultiChecked(){
        $ids = $_POST['id'];
        $product_ids = '';
        $username = Yii::$app->user->identity->username;
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `domestic_freight` set `has_checked`= 1,`auditor`= '$username',`checked_time`=Now() where `dfid` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }


    }

    /**
     * @throws \yii\db\Exception
     * @description 取消标记
     */
    public function  actionMultiUnChecked(){
        $ids = $_POST['id'];
        $product_ids = '';
        $username = Yii::$app->user->identity->username;
        foreach ($ids as $k=>$v){
            $product_ids.=$v.',';
        }
        $ids_str = trim($product_ids,',');

        if(isset($ids)&&!empty($ids)){
            $res = Yii::$app->db->createCommand("
            update `domestic_freight` set `has_checked`= 0,`auditor`= '$username',`checked_time`=Now() where `dfid` in ($ids_str)
            ")->execute();
            if($res){
                echo 'success';
            }
        }else{
            echo 'error';
        }
    }

}
