<?php

namespace backend\controllers;

use Yii;
use backend\models\YaeFoodLists;
use backend\models\YaeUserFood;
use backend\models\YaeFoodListsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * YaeFoodListsController implements the CRUD actions for YaeFoodLists model.
 */
class YaeFoodListsController extends Controller
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
     * Lists all YaeFoodLists models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YaeFoodListsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single YaeFoodLists model.
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
     * Creates a new YaeFoodLists model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new YaeFoodLists();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing YaeFoodLists model.
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
     * Deletes an existing YaeFoodLists model.
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
     * Finds the YaeFoodLists model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return YaeFoodLists the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = YaeFoodLists::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    public  function actionPrefer()
    {

        $model = new YaeFoodLists();
        $user_food =  new  YaeUserFood();
        $info_data = $this->actionInfo();

        $user_id = $info_data['user_id'];
        $begintime = $info_data['begintime'];
        $endtime = $info_data['endtime'];
        $old_food_id = $info_data['old_food_id'];

        $res = Yii::$app->db->createCommand("
                SELECT count(*) as num  FROM `yae_user_food`  d 
                WHERE d.user_id= $user_id
                AND ( d.order_date BETWEEN '$begintime' AND '$endtime' )
                and d.food_id is not  null 
            ")->queryScalar();

        $model->food_name = $old_food_id;

        if(!empty($res)){ //如果不空的  更新 yae_user_food

            if ($model->load(Yii::$app->request->post()) ) {
                $new_food_id =  Yii::$app->request->post()["YaeFoodLists"]["food_name"];

                   $return_info = Yii::$app->db->createCommand("
                    update `yae_user_food` set `food_id`=$new_food_id where `food_id`=$old_food_id 
                    and `user_id`=$user_id and ( order_date BETWEEN '$begintime' AND '$endtime' )
                    ")->execute();
            }

            $food = $this->actionFoodLists();

            return $this->render('food_lists', [
                'model' => $model,
                'food'=>$food
            ]);
        }
        else{ // 否则创建

            $food = $this->actionFoodLists();
            if ($model->load(Yii::$app->request->post()) ) {
                $user_food->food_id =  Yii::$app->request->post()["YaeFoodLists"]["food_name"];
                $user_food->user_id = $user_id;
                ;

            }

            return $this->render('food_lists', [
                'model' => $model,
                'food'=>$food
            ]);


        }



    } //end Action prefer


    public  function  actionFoodLists(){

        $dinner = Yii::$app->db->createCommand(" 
                            SELECT s.`id`,s.`food_name` from `yae_food_lists` s
                         ")->queryAll();
        $food = [];
        foreach ($dinner as $k=>$v){
            $food[$v['id']] = $v['food_name'];
        }

        return $food;

    }


    public function actionInfo(){
        $user_id   = Yii::$app->user->identity->getId();
        $begintime = date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d'),date('Y')));
        $endtime   = date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1);
        $old_food_id = Yii::$app->db->createCommand("
                SELECT  d.food_id  FROM `yae_user_food`  d 
                WHERE d.user_id= $user_id
                AND ( d.order_date BETWEEN '$begintime' AND '$endtime' )
                and d.food_id is not null 
            ")->queryOne();
       $info_data =[];
       $info_data['user_id']   = $user_id;
       $info_data['begintime'] = $begintime;
       $info_data['endtime']   = $endtime;
       $info_data['old_food_id']   = $old_food_id['food_id'];
       return $info_data;

    }

    public  function actionCancel()
    {
        $info_data = $this->actionInfo();

        $user_id = $info_data['user_id'];
        $begintime = $info_data['begintime'];
        $endtime = $info_data['endtime'];
        $old_food_id = $info_data['old_food_id'];


        $res =  Yii::$app->db->createCommand("
                    delete from  `yae_user_food`  where `food_id`=$old_food_id
                    and `user_id`=$user_id and ( order_date BETWEEN '$begintime' AND '$endtime' )
                    ")->execute();
       if($res){
           echo 'Cancel后那么今天没点餐哦^_^';
       }

    }
}