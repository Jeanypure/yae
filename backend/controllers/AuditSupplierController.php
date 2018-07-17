<?php

namespace backend\controllers;

use Yii;
use backend\models\YaeSupplier;
use backend\models\AuditSupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  \PHPExcel;
/**
 * AuditSupplierController implements the CRUD actions for YaeSupplier model.
 */
class AuditSupplierController extends Controller
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
        $searchModel = new AuditSupplierSearch();
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
     * Updates an existing YaeSupplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $username = Yii::$app->user->identity->username;
        if ($model->load(Yii::$app->request->post()) ) {
            $model-> checker = $username;
            $model-> check_date = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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


    public function actionExport(){
        $objPHPExcel = new \PHPExcel();

//mysql查询语
        $data = YaeSupplier::find()->asArray()->all();

        $header_arr = [
            'A1'=>'供应商代码',
            'B1'=>'供应商名称',
            'C1'=>'供应商英文名称',
            'D1'=>'等级',
            'E1'=>'合作类型',
            'F1'=>'主营品类(代码)',
            'G1'=>'供应商类型',
            'H1'=>'默认采购员',
            'I1'=>'默认跟单员',
            'J1'=>'支付周期',
            'K1'=>'结算方式',
            'L1'=>'预付比例%',
            'M1'=>'支付方式',
            'N1'=>'支付平台',
            'O1'=>'支行名称',
            'P1'=>'收款省/直辖市',
            'Q1'=>'收款市县',
            'R1'=>'收款账号',
            'S1'=>'收款银行',
            'T1'=>'收款人',
            'U1'=>'运输承担方',
            'V1'=>'运输支付方式',
            'W1'=>'QC不良品处理',
            'X1'=>'合同采购金额',
            'Y1'=>'默认运输方式',
            'Z1'=>'默认承运商',
            'AA1'=>'供应商佣金比例',
            'AB1'=>'店铺网址',
            'AC1'=>'组织机构(代码)',
        ];

        $pay_cycleTime_type = [0 => '其他',1 => '日结', 2 => '周结',3 => '半月结',4 => '月结',5 => '隔月结'];
        $account_type = [1 => '货到付款', 2 => '款到发货',3 => '周期结算',4 => '售后付款',5 => '默认方式' ];

        //设置表格头的输出
        foreach($header_arr as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$key", "$value");
        }

        foreach($data as $k=>$v) {
            $num= $k+2;
            $objPHPExcel->setActiveSheetIndex(0)
            //Excel的第A列，uid是你查出数组的键值，下面以此类推
            ->setCellValue('A'.$num, $v['supplier_code'])
            ->setCellValue('B'.$num, $v['supplier_name'])
            ->setCellValue('H'.$num, $v['submitter'])
            ->setCellValue('J'.$num, $pay_cycleTime_type[$v['pay_cycleTime_type']])
            ->setCellValue('K'.$num, $account_type[$v['account_type']])
            ->setCellValue('M'.$num, '现金')
            ;
        }

        //数据结束
        ob_end_clean();
        ob_start();
        $objPHPExcel->getActiveSheet()->setTitle('供应商信息');
        $objPHPExcel->setActiveSheetIndex(0);



        //创建第二个工作表
        $msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '联系方式'); //创建一个工作表
        $objPHPExcel->addSheet($msgWorkSheet); //插入工作表
        $objPHPExcel->setActiveSheetIndex(1); //切换到新创建的工作表
        $header_arr2 = [
            'A1' => '供应商代码',
            'B1' => '联系人',
            'C1' => '联系电话',
            'D1' => '中文联系地址',
            'E1' => '联系邮编',
            'F1' => 'FAX',
            'G1' => '英文联系地址',
            'H1' => 'QQ',
            'I1' => '微信',
            'J1' => '旺旺',
            'K1' => 'Skype',
        ];
        //设置表格头的输出
        foreach($header_arr2 as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue("$key", "$value");
        }
        //写入多行数据
        foreach($data as $k=>$v){
            $k = $k+2;
            /* @func 设置列 */
            $objPHPExcel->getactivesheet()->setcellvalue('A'.$k, $v['supplier_code']);
            $objPHPExcel->getactivesheet()->setcellvalue('B'.$k, $v['supplier_name']);
            $objPHPExcel->getactivesheet()->setcellvalue('C'.$k, $v['submitter']);
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="易仓供应商-联系人模板.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}
