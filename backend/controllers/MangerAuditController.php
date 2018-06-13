<?php

namespace backend\controllers;

use backend\models\Company;
use Yii;
use backend\models\PurInfo;
use backend\models\MangerAuditSearch;
use backend\models\Preview;
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

       $preview =   Preview::find()->where(['product_id'=>$id])->all();
       $leader =   Yii::$app->db->createCommand("
       select sub_company, leader from `company`
       ")->queryAll();

       $data = [] ;
       foreach($leader as $key=>$value){
           $data[$value['sub_company']] = $value['leader'];
       }

       $num = sizeof($preview);
       $model_update = $this->findModel($id);
       $exchange_rate = PurInfoController::actionExchangeRate();

        if($num ==3){
            if ($model_update->load(Yii::$app->request->post()) ) {
//                $new_member = Yii::$app->request->post()['PurInfo']['new_member'];
//                if($new_member!= $model_update->pur_group){ //插入preview  重新分部
//                    $model_update->pur_group = $new_member;
//                    Yii::$app->db->createCommand("
//                    INSERT INTO `preview`  (member2,product_id) value ('$new_member',$id)
//                  ")->execute();
//
//                }
                //采样状态 入采样流程
                if(Yii::$app->request->post()['PurInfo']['master_result']==1 ){
                    Yii::$app->db->createCommand("
                    INSERT INTO `sample`  (spur_info_id) value ($id)
                  ")->execute();
                }

                $model_update->preview_status = 1;
                $model_update->save(false);

                return $this->redirect(['index']);
            }
            return $this->render('view', [
                'model' => $this->findModel($id),
                'preview' => $preview[0],
                'preview2' => $preview[1],
                'preview3' => $preview[2],
                'num' =>$num,
                'model_update' =>$model_update,
                'exchange_rate' =>$exchange_rate,
                'data' =>$data,

            ]);
        }elseif($num ==2){
          if ($model_update->load(Yii::$app->request->post()) ) {
              $new_member = Yii::$app->request->post()['PurInfo']['new_member']; //部门ID
              $member2 = Yii::$app->db->createCommand(" select leader from company where sub_company = $new_member
              ")->queryOne();
              if($new_member!= $model_update->pur_group){ //进入preview
                  $model_update->pur_group = $new_member;
                  Yii::$app->db->createCommand("
                    INSERT INTO `preview`  (member2,product_id) value ('$member2[leader]',$id)
                  ")->execute();

              }
              //采样状态 入采样流程
              if(Yii::$app->request->post()['PurInfo']['master_result']==1 ){
                  Yii::$app->db->createCommand("
                    INSERT INTO `sample`  (spur_info_id) value ($id)
                  ")->execute();
              }

              $model_update->preview_status = 1;
              $model_update->save(false);

              return $this->redirect(['index']);
          }
          return $this->render('view', [
              'model' => $this->findModel($id),
              'preview' => $preview[0],
              'preview2' => $preview[1],
              'num' =>$num,
              'model_update' =>$model_update,
              'exchange_rate' =>$exchange_rate,
              'data' =>$data,
          ]);
        }elseif($num ==1){
          if ($model_update->load(Yii::$app->request->post())) {
              //采样状态 入采样流程
              if(Yii::$app->request->post()['PurInfo']['master_result']==1 ){
                  Yii::$app->db->createCommand("
                    INSERT INTO `sample`  (spur_info_id) value ($id)
                  ")->execute();
              }

              $model_update->preview_status = 1;
              $model_update->save(false);
              return $this->redirect(['index']);

          }

          return $this->render('view', [
              'model' => $this->findModel($id),
              'num' =>$num,
              'preview' => $preview[0],
              'model_update' =>$model_update,
              'exchange_rate' =>$exchange_rate,
              'data' =>$data,
          ]);

      }
    }

    /**
     * Creates a new PurInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
                $model->preview_status = 1;
                $model->save(false);
                return $this->redirect(['index']);
            }

            return $this->renderAjax('update_audit', [
                'model' => $model,
            ]);
        }




    }


}
