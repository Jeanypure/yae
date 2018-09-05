<?php

namespace backend\controllers;

use Yii;
use backend\models\YaeSupplier;
use backend\models\SupplierContact;
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
        $supplier_contact = SupplierContact::find()->andWhere(['supplier_id'=>$id])->one();
        $username = Yii::$app->user->identity->username;
        if ($model->load(Yii::$app->request->post()) ) {
            $model-> checker = $username;
            $model-> check_date = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'supplier_contact' => $supplier_contact,
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


    public function actionExport($id){
        $objPHPExcel = new \PHPExcel();
        $com_data = $this->actionDataCommon($id);
          $data = $com_data['data'];
          $contants = $com_data['contants'];
          $pay_cycleTime_type = $com_data['pay_cycleTime_type'];
          $account_type = $com_data['account_type'];
        //mysql查询语

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



        //设置表格头的输出
        foreach($header_arr as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$key", "$value");
        }
            $num= 2;
            $objPHPExcel->setActiveSheetIndex(0)
            //Excel的第A列，uid是你查出数组的键值，下面以此类推
            ->setCellValue('A'.$num, $data['supplier_code'])
            ->setCellValue('B'.$num, $data['supplier_name'])
            ->setCellValue('H'.$num, $data['submitter'])
            ->setCellValue('J'.$num, $pay_cycleTime_type[$data['pay_cycleTime_type']])
            ->setCellValue('K'.$num, $account_type[$data['account_type']])
            ->setCellValue('L'.$num, $data['account_proportion'])
            ->setCellValue('M'.$num, '现金')
  ;


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

        // 写入多行数据

            $k = 2;
            /* @func 设置列 */
            $objPHPExcel->getactivesheet()->setcellvalue('A'.$k, $data['supplier_code'])
                ->setcellvalue('B'.$k, $contants['contact_name'])
                ->setcellvalue('C'.$k, $contants['contact_tel'])
                ->setcellvalue('D'.$k, $contants['contact_address'])
                ->setcellvalue('H'.$k, $contants['contact_qq'])
                ->setcellvalue('I'.$k, $contants['contact_wechat'])
                ->setcellvalue('J'.$k, $contants['contact_wangwang'])
                ->setcellvalue('K'.$k, $contants['skype']);
        //创建第3个工作表
        $msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '基础数据——主营品类'); //创建一个工作表
        $objPHPExcel->addSheet($msgWorkSheet); //插入工作表
        //创建第4个工作表
        $msgWorkSheet = new \PHPExcel_Worksheet($objPHPExcel, '基础数据——银行'); //创建一个工作表
        $objPHPExcel->addSheet($msgWorkSheet); //插入工作表

        //更新状态已导易仓
        $this->actionMendEccang($id);
        $filename = date('Y-m-d')."导供应商-联系人到易仓.xls";
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    /**
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function actionMendEccang($id){
        $sql = "update yae_supplier  SET into_eccang_status=1,into_eccang_date=NOW() where id = $id ";
        try{
            $res = Yii::$app->db->createCommand($sql)->execute();
        }catch(\Exception $exception){
            throw $exception;
        }
        return 'success';

    }

    public function  actionDataCommon($id){
        $com_data =[];
        //mysql查询语
        $data = YaeSupplier::find()->asArray()->where(['id'=>$id])->one();
        $contants = SupplierContact::find()
            ->asArray()
            ->where(['supplier_id'=>$id])
            ->one();

        $pay_cycleTime_type = [1 => '日结', 2 => '周结',3 => '半月结',4 => '月结',5 => '隔月结',6 => '其它',];
        $account_type = [1 => '货到付款', 2 => '款到发货',3 => '周期结算',4 => '售后付款',5 => '默认方式',6 => '其它'];
        $com_data['data'] = $data;
        $com_data['contants'] = $contants;
        $com_data['pay_cycleTime_type'] = $pay_cycleTime_type;
        $com_data['account_type'] = $account_type;
        return $com_data;

    }

    public function actionExportToNs($id){
        $objPHPExcel = new \PHPExcel();
        $com_data = $this->actionDataCommon($id);
        $data = $com_data['data'];
        $contants = $com_data['contants'];
        $pay_cycleTime_type = $com_data['pay_cycleTime_type'];
        $account_type = $com_data['account_type'];
        $bill_type = ['16%专票','3%专票','增值税普通发票'];
        $company = [
            '2'=>'上海商舟船舶用品有限公司',
            '3'=>'雅耶国际贸易(上海)有限公司',
            '5'=>'上海朗探贸易有限公司',
            '6'=>'上海域聪贸易有限公司',
            '7'=>'上海朋侯贸易有限公司',
            '8'=>'上海客尊贸易有限公司',
        ];
        $header = [
            'A1' => '供应商代码',
            'B1' => '供应商名称',
            'C1' => '供应商地址',
            'D1' => '支付周期类型',
            'E1' => '结算方式',
            'F1' => '预付比例%',
            'G1' => '开票类型',
            'H1' => '是否为合作过的供应商',
            'I1' => '默认产品开发员',
            'J1' => '开户银行',
            'K1' => '银行收款账号',
            'L1' => '联系人',
            'M1' => '联系人职位',
            'N1' => '联系电话',
            'O1' => 'QQ',
            'P1' => '微信',
            'Q1' => '注意事项',
            'R1' => '公司',
        ];
        //设置表格头的输出
        foreach($header as $key=>$value){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$key", "$value");
        }
        $num= 2;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $data['supplier_code'])
            ->setCellValue('B'.$num, $data['supplier_name'])
            ->setCellValue('C'.$num, $data['supplier_address'])
            ->setCellValue('D'.$num, $pay_cycleTime_type[$data['pay_cycleTime_type']])
            ->setCellValue('E'.$num, $account_type[$data['account_type']])
            ->setCellValue('F'.$num, $data['account_proportion'].'%')
            ->setCellValue('G'.$num, $bill_type[$data['bill_type']])
            ->setCellValue('H'.$num, $data['has_cooperate']==1?'是':'否')
            ->setCellValue('I'.$num, $data['submitter'])
            ->setCellValue('J'.$num, $data['pay_bank'])
            ->setCellValue('K'.$num, $data['pay_card'] )
            ->setCellValue('L'.$num, $contants['contact_name'])
            ->setCellValue('N'.$num, $contants['contact_tel'])
            ->setCellValue('O'.$num, $contants['contact_qq'])
            ->setCellValue('P'.$num,  $contants['contact_wechat'])
            ->setCellValue('Q'.$num, $data['sup_remark'])
            ->setCellValue('R'.$num, '总公司 : '.$company[$data['sale_company']]);
        //数据结束
        ob_end_clean();
        ob_start();
        $objPHPExcel->getActiveSheet()->setTitle('供应商基本信息-采购填');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename = date('Y-m-d')."导供应商+联系人到NetSuite.xls";
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }

        public  function actionExportCsv($id){
           /* $com_data = $this->actionDataCommon($id);
            $data = $com_data['data'];
            $contants = $com_data['contants'];
            var_dump($com_data);die;*/
            $da = '';
            $this->export_csv($da);
        }



    function export_csv($data)
    {
        /*$header= ['供应商代码',
            '供应商名称',
            '供应商地址',
            '支付周期类型',
            '结算方式',
            '预付比例%',
            '开票类型',
            '是否为合作过的供应商',
            '默认产品开发员',
            '开户银行',
            '银行收款账号',
            '联系人',
            '联系人职位',
            '联系电话',
            'QQ',
            '微信',
            '注意事项',
            '公司',
        ];*/
        $header = [
            '用户名','密码'
        ];
        //转码
        foreach ($header as $key => $val){
            $head[$key] = mb_convert_encoding($val,'gbk','utf-8');
        }
        $data=array(
            array("username"=>"test1","password"=>"123"),
            array("username"=>"test2","password"=>"456"),
            array("username"=>"test3","password"=>"789"),
        );

        $string="";
        foreach ($data as $key => $value)
        {

            foreach ($value as $k => $val)
            {
                $value[$k]=iconv('utf-8','gb2312',$value[$k]);
            }

            $string .= implode(",",$value)."\n"; //用英文逗号分开
        }
        $filename = date('Ymd').'.csv'; //设置文件名
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=".$filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $string;
    }


}
