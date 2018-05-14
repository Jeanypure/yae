<?php

namespace backend\controllers;

use Yii;
use backend\models\Preview;
use backend\models\MangerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * MangerController implements the CRUD actions for Preview model.
 */
class MangerController extends Controller
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
     * Lists all Preview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MangerSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
        $count = Yii::$app->db->createCommand("
                       SELECT p.`product_id`,
                        o.`pd_pic_url`,
                        Max(case p.member when 'Jenny' then p.result else 0 end)   'Jenny',
                        Max(case p.member when 'admin' then p.result else 0 end ) 'admin',
                        Max(case p.member when 'Heidi' then p.result else 0 end)  'Heidi',
                        Max(case p.member when 'Max' then p.result else 0 end)  'Max'
                        FROM `preview` p
                        LEFT JOIN `pur_info` o  on o.pur_info_id = p.`product_id`
                        GROUP BY p.`product_id`
             ")->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => "
                        SELECT p.`product_id`,
                        o.`pd_pic_url`,
                        o.`pd_title`,
                        o.`pd_title_en`,
                        Max(case p.member when 'Jenny' then p.result else 0 end)   'Jenny',
                        Max(case p.member when 'admin' then p.result else 0 end ) 'admin',
                        Max(case p.member when 'Heidi' then p.result else 0 end)  'Heidi',
                        Max(case p.member when 'Max' then p.result else 0 end)  'Max'
                        FROM `preview` p
                        LEFT JOIN `pur_info` o  on o.pur_info_id = p.`product_id`
                        GROUP BY p.`product_id`

                        ",
            'totalCount' => $count,
            'sort' => [
                'attributes' => [
                    'product_id',
                    'Jenny',
                    'Max',
                    'Heidi',

//                    'name' => [
//                        'asc' => ['product_id' => SORT_ASC, 'member' => SORT_ASC],
//                        'desc' => ['product_id' => SORT_DESC, 'member' => SORT_DESC],
//                        'default' => SORT_DESC,
//                        'label' => 'Name',
//                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

            // get the user records in the current page
        $models = $dataProvider->getModels();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $models,
        ]);


    }

    /**
     * Displays a single Preview model.
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
     * Creates a new Preview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Preview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->preview_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Preview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->preview_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Preview model.
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
     * Finds the Preview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Preview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Preview::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
