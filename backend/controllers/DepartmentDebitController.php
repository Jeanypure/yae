<?php

namespace backend\controllers;

use Yii;
use backend\models\YaeFreight;
use backend\models\FreightFee;
use backend\models\DepartmentDebitSearch;
use backend\models\FreightFeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
/**
 * DepartmentDebitController implements the CRUD actions for YaeFreight model.
 */
class DepartmentDebitController extends Controller
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
     * Lists all YaeFreight models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentDebitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single YaeFreight model.
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
     * Creates a new YaeFreight model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new YaeFreight();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing YaeFreight model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $total = Yii::$app->db->createCommand("SELECT 
                        CASE currency WHEN 1 THEN 'USD'
                        WHEN 2 THEN 'GBP' 
                        WHEN 3 THEN 'CAD' 
                        WHEN 4 THEN 'EUR' 
                        WHEN 5 THEN 'RMB'
                        ELSE '其他'
                        END AS currency, 
                         SUM(amount) as total
                        from freight_fee WHERE freight_id=$id
                        GROUP BY currency;
        ")->queryAll();
//        $query = FreightFee::find()->indexBy('id')->where(['freight_id'=>$id]); // where `id` is your primary key
        $query = FreightFee::find()->alias('e')
            ->leftJoin('fee_category y','e.description_id=y.id')
            ->select('e.*,y.name_zn')
            ->indexBy('id')->where(['freight_id'=>$id]); // where `id` is your primary key
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        if ($model->load(Yii::$app->request->post()) ) {
             $model->mini_deal = 1 ;
             $model->to_financial = 1 ;
             $model->save();
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'total' => $total,
        ]);

    }

    /**
     * Deletes an existing YaeFreight model.
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
     * Finds the YaeFreight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return YaeFreight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = YaeFreight::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExport($id = null ){
        $objPHPExcel = new \PHPExcel();
        $header = [
            'A1' => '付款人',
            'B1' => '收款人',
            'C1' => '合同号',
            'D1' => '单号',
            'E1' => 'rmb',
            'F1' => 'usd',
            'G1' => 'cad',
            'H1' => 'gbp',
            'I1' => 'eur',
            'J1' => '备注',

        ];
        $sql = "
                SELECT 
                t.bill_to,
                t.receiver,
                t.contract_no,
                t.debit_no,
                t.remark,
                MAX(CASE e.currency WHEN 5 THEN e.amount ELSE 0 END ) RMB,
                MAX(CASE e.currency WHEN 3 THEN e.amount ELSE 0 END ) CAD,
                MAX(CASE e.currency WHEN 1 THEN e.amount ELSE 0 END ) USD,
                MAX(CASE e.currency WHEN 2 THEN e.amount ELSE 0 END ) GBP,
                MAX(CASE e.currency WHEN 4 THEN e.amount ELSE 0 END ) EUR
                FROM yae_freight  t 
                LEFT JOIN freight_fee e ON e.freight_id=t.id
                WHERE t.id IN ($id)
                GROUP BY t.bill_to,
                t.receiver,
                t.contract_no,
                t.debit_no;
        ";

        $data =  Yii::$app->db->createCommand($sql)->queryAll();
        $company = Yii::$app->db->createCommand("select sub_company,memo from company")->queryAll();
        $company_arr = [];
        foreach($company as $key=>$val){
            $company_arr[$val['sub_company']]  = $val['memo'];
        }

        //设置表格头的输出
        foreach($header as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$key", "$value");
        }
        foreach ($data as $k =>$v){
            $num= 2;
            $num = $num+$k;
            $objPHPExcel->setActiveSheetIndex(0)
                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                ->setCellValue('A'.$num, $company_arr[$v['bill_to']])
                ->setCellValue('B'.$num, $v['receiver'])
                ->setCellValue('C'.$num, $v['contract_no'])
                ->setCellValue('D'.$num, $v['debit_no'])
                ->setCellValue('E'.$num, $v['RMB'])
                ->setCellValue('F'.$num, $v['USD'])
                ->setCellValue('G'.$num, $v['CAD'])
                ->setCellValue('H'.$num, $v['GBP'])
                ->setCellValue('I'.$num, $v['EUR'])
            ;
        }

        //汇总项
        $sum  = count($data) + 2;
        $v  = count($data) + 1;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D'.$sum, '汇总')
            ->setCellValue('E'.$sum, "=SUM(E2:E{$v})")
            ->setCellValue('F'.$sum, "=SUM(F2:F{$v})")
            ->setCellValue('G'.$sum, "=SUM(G2:G{$v})")
            ->setCellValue('H'.$sum, "=SUM(H2:H{$v})")
            ->setCellValue('I'.$sum, "=SUM(I2:I{$v})") ;

        //数据结束
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="货代费用表格.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }
}
