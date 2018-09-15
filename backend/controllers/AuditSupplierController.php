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
            $model->save(false);

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




    public function actionExportToNs($id){
        $objPHPExcel = new \PHPExcel();
        $query = YaeSupplier::find()->select(['r.supplier_code','r.supplier_name','r.pd_bill_name','r.bill_unit','r.submitter',
            'r.bill_type','r.pay_card','r.pay_name','r.pay_bank','r.sup_remark','r.pay_cycleTime_type','r.account_type',
            'r.account_proportion','r.has_cooperate','r.sale_company','r.supplier_address',
            't.supplier_id','t.contact_name','t.contact_tel','t.contact_address','t.contact_qq','t.contact_wechat','t.contact_wangwang',
            't.contact_memo']);
        $query->from(YaeSupplier::tableName() . 'r');
        $query->leftJoin('supplier_contact t', 't.supplier_id=r.id');
        $data = $query->Where('r.id IN('.$id.')')->orderBy('r.id desc')->asArray()->all();

        $pay_cycleTime_type = [1 => '日结', 2 => '周结',3 => '半月结',4 => '月结',5 => '隔月结',6 => '其它',];
        $account_type = [1 => '货到付款', 2 => '款到发货',3 => '周期结算',4 => '售后付款',5 => '默认方式',6 => '其它'];
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

        foreach($data as $key=>$value){

            $num= $key+2;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$num, $value['supplier_code'])
                ->setCellValue('B'.$num, $value['supplier_name'])
                ->setCellValue('C'.$num, $value['supplier_address'])
                ->setCellValue('D'.$num, $pay_cycleTime_type[$value['pay_cycleTime_type']])
                ->setCellValue('E'.$num, $account_type[$value['account_type']])
                ->setCellValue('F'.$num, $value['account_proportion'].'%')
                ->setCellValue('G'.$num, $bill_type[$value['bill_type']])
                ->setCellValue('H'.$num, $value['has_cooperate']==1?'是':'否')
                ->setCellValue('I'.$num, $value['submitter'])
                ->setCellValue('J'.$num, $value['pay_bank'])
                ->setCellValue('K'.$num, "'".$value['pay_card'] )
                ->setCellValue('L'.$num, $value['contact_name'])
                ->setCellValue('N'.$num, $value['contact_tel'])
                ->setCellValue('O'.$num, $value['contact_qq'])
                ->setCellValue('P'.$num, $value['contact_wechat'])
                ->setCellValue('Q'.$num, $value['sup_remark'])
                ->setCellValue('R'.$num, '母公司 : '.$company[empty($value['sale_company'])?'2':$value['sale_company']]);
        }

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



    /**
     * 重写fputcsv方法，添加转码功能
     * @param $handle
     * @param array $fields
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape_char
     */
    function actionFputcsv2($handle, array $fields, $delimiter = ",", $enclosure = '"', $escape_char = "\\") {
        foreach ($fields as $k => $v) {
            $fields[$k] = iconv("UTF-8", "GB2312//IGNORE", $v);  // 这里将UTF-8转为GB2312编码
        }
         fputcsv($handle, $fields, $delimiter, $enclosure, $escape_char);
    }

    function actionExportToNshh($id) {
        // 文件名
        $filename = "供应商信息" . date('Y-m-d H:i:s');
        // 设置输出头部信息
        header('Content-Encoding: UTF-8');
        header("Content-Type: text/csv; charset=UTF-8");
        header("Content-Disposition: attachment; filename={$filename}.csv");
        $tableHead = ['供应商代码','供应商名称','供应商地址','支付周期类型','结算方式','预付比例%','开票类型','是否为合作过的供应商','默认产品开发员',
            '开户银行','银行收款账号','联系人','联系人职位','联系电话','QQ','微信','注意事项', '公司',];
        // 获取句柄
        $output = fopen('php://output', 'w') or die("can't open php://output");

        // 输出头部标题
        $this->actionFputcsv2($output, $tableHead);

        //记录

        $list = $this->actionRecords($id);
        foreach ($list as $item) {
             $this->actionFputcsv2($output, array_values($item));
        }

        // 关闭句柄
        fclose($output) or die("can't close php://output");
    }

    public function actionSignToNetsuite($id){
       $res =  Yii::$app->db->createCommand("update yae_supplier set has_tons =1 where id in ($id)")->execute();
       if($res){
           return 'success';
       }else{
           return 'error';
       }

    }

    public  function  actionRecords($id){
        $query = YaeSupplier::find()->select(['r.supplier_code','r.supplier_name','r.supplier_address',
            'r.pay_cycleTime_type', 'r.account_type','r.account_proportion','r.bill_type','r.has_cooperate',
            'r.submitter','r.pay_bank','r.pay_card','t.contact_name', 't.contact_memo','t.contact_tel','t.contact_qq',
            't.contact_wechat','r.sup_remark','r.sale_company',
//            'r.pay_name','t.supplier_id','t.contact_address','t.contact_wangwang','r.pd_bill_name','r.bill_unit'
            ]);
        $query->from(YaeSupplier::tableName() . 'r');
        $query->leftJoin('supplier_contact t', 't.supplier_id=r.id');
        $data = $query->Where('r.id IN('.$id.')')->orderBy('r.id desc')->asArray()->all();
        $pay_cycleTime_type = [1 => '日结', 2 => '周结',3 => '半月结',4 => '月结',5 => '隔月结',6 => '其它',];
        $account_type = [1 => '货到付款', 2 => '款到发货',3 => '周期结算',4 => '售后付款',5 => '默认方式',6 => '其它'];
        $bill_type = ['16%专票','3%专票','增值税普通发票'];
        $company = [
            '2'=>'上海商舟船舶用品有限公司',
            '3'=>'雅耶国际贸易(上海)有限公司',
            '5'=>'上海朗探贸易有限公司',
            '6'=>'上海域聪贸易有限公司',
            '7'=>'上海朋侯贸易有限公司',
            '8'=>'上海客尊贸易有限公司',
        ];
        $list = [];
        foreach ($data as $key=>$val){
            $val['pay_cycleTime_type'] = $pay_cycleTime_type[$val['pay_cycleTime_type']];
            $val['account_type'] = $account_type[$val['account_type']];
            $val['bill_type'] = $bill_type[$val['bill_type']];
            $val['sale_company'] = '母公司 : '.$company[empty($value['sale_company'])?'2':$value['sale_company']];
            $val['has_cooperate'] = $val['has_cooperate']==1?'是':'否';
            $list[] = $val;
        }
        return $list;
    }

}
