<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\DepartmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Company;

/**
 * DepartmentController implements the CRUD actions for Product model.
 */
class DepartmentAssignController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
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


    public function  actionAccept()
    {
        $ids = $_POST['id'];
        if($ids){
            foreach($ids as $val){
                $model = $this->findModel($val);
                $model->accept_status = 1;
                $model->save(false);
            }
            echo 'success!';

        }
        else{
            echo 'error!';

        }

    }
    public function  actionReject()
    {
        $ids = $_POST['id'];
        if($ids){
            foreach($ids as $val){
                $model = $this->findModel($val);
                $model->accept_status = 0;
                $model->save(false);
            }
            echo 'success!';

        }
        else{
            echo 'error!';

        }

    }

    /**
     * @desciption 销售推荐产品给采购主管
     */

    public function actionPickPurchaserLeader($id){
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())&& $model->save(false)){
            return $this->redirect('index');
        }
        $pur_set= $this->actionWhichPurchaser($model->purchaser);


        return  $this->renderAjax('pick_purchaser', [
            'model' => $model,
            'id' =>$id,
            'purset' =>$pur_set,
        ]);
    }

    /**
     * can pick purchaser which hasn't full tasks
     * the full tasks equal 3
     * @description 采购主管把产品分给自己或者组员
     */
    public function actionPickPurchaser($id)
    {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save(false))
        {
            $sql = "
                    set @id = $id;
                    call product_to_purinfo(@id)
                    ";

            $res    = Yii::$app->db->createCommand($sql)->execute();
            return $this->redirect('index');
        }

        $pur_set= $this->actionWhichMember($model->purchaser);


        return  $this->renderAjax('pick_purchaser', [
            'model' => $model,
            'id' =>$id,
            'purset' =>$pur_set,
        ]);


    }

    public function actionWhichMember($purchaser_leader)
    {
        //跟据采购主管找到code  再根据code找到组员集合
        $codeRet = Yii::$app->db->createCommand("select code from purchaser where  purchaser='$purchaser_leader'")->queryOne();
        $code = $codeRet['code'];
        $pur_has = Yii::$app->db->createCommand(" 
                            SELECT 
                            p.`purchaser`,
                            count(*) as num         
                         from `product` p  left  join `purchaser` pu on  pu.purchaser=p.purchaser_leader
                          WHERE  
                           pu.`code`= $code AND has_used=1
                         GROUP BY p.`purchaser` 
                         ")->queryAll();
        $pur_non = Yii::$app->db->createCommand(" 
                            SELECT 
                            p.`purchaser`,
                            0 as num         
                         from `purchaser` p 
                         where p.`code`= $code AND has_used=1
                         GROUP BY p.`purchaser` 
                         ")->queryAll();

        $has_arr=[];
        $non_arr=[];
        $pur_set=[];
        foreach ($pur_has as $key=>$val){
            $has_arr[$val["purchaser"]] = $val['num'];
        }
        foreach ($pur_non as $key=>$val){
            $non_arr[$val["purchaser"]] = $val['num'];
        }

        $meg = array_merge($non_arr,$has_arr);

        foreach($meg as $k=>$val){
            if($val==22)   unset($meg[$k]) ; //任务数满 不可选
        }
        foreach($meg as $k=>$val){
            $pur_set[$k] = $k;
        }

        if(!empty($purchaser))
        {
            $pur_set[$purchaser] = $purchaser;

        }
        return $pur_set;
    }



}
