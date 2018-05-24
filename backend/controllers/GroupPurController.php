<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\GroupPurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupPurController implements the CRUD actions for PurInfo model.
 */
class GroupPurController extends Controller
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
        $searchModel = new GroupPurSearch();
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
        $rate = $this->actionExchangeRate();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'exchange_rate' => $rate

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
        $rate = $this->actionExchangeRate();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->preview_status = '待评审';
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'exchange_rate' => $rate
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
     * Find exchange rate
     * @return mixed
     * @throws \yii\db\Exception
     */
    public  function actionExchangeRate(){
        $res = Yii::$app->db->createCommand("
        select t1.`exchange_rate` from `yae_exchange_rate`  t1 where t1.`currency`='USD'
        ")->queryOne();
        $rate = $res['exchange_rate'];
        return $rate;
    }



    /**To Brocast the Product model based on its primary key value.
     * mark the status brocasting
     */

    public function actionBrocast()
    {
        $ids = $_POST['id'];
        $val='';
        $id_set='';
        if($ids){
            foreach ($_POST['id'] as $key=>$value){
                  $val.=$value.',';
            }
            $id_set = trim($val,',');
            Yii::$app->db->createCommand("
                update `pur_info` set `brocast_status` = '公示中'  WHERE `pur_info_id` in ($id_set)
            ")->execute();
            echo '公示产品成功';
        }else{
            echo '请选择公示产品!';

        }
    }

    /**
     * To end brocast the Product based on its primary key value
     * @throws NotFoundHttpException
     */
    public function actionEndBrocast()
    {
        $ids = $_POST['id'];
        $val = '';
        $id_set = '';
        if($ids){
            foreach ($_POST['id'] as $key=>$value){
                $val.=$value.',';
            }
            $id_set = trim($val,',');
            Yii::$app->db->createCommand("
                update `pur_info` set `brocast_status` = '公示结束'  WHERE `pur_info_id` in ($id_set)
            ")->execute();

            echo '产品公示结束!';

        }
        else{
            echo '请选择产品!';

        }
    }


}
