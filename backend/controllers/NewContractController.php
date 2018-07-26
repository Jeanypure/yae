<?php

namespace backend\controllers;

use Yii;
use backend\models\NewContract;
use backend\models\NewContractSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewContractController implements the CRUD actions for NewContract model.
 */
class NewContractController extends Controller
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
     * Lists all NewContract models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewContractSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    public function actionExport($id = null ){
        $objPHPExcel = new \PHPExcel();
        $sql = " SELECT  buy_company,factory,purchase_contract_no,product_name,unit,quantity,amount,declare_no,
                purchaser,sku  FROM new_contract where  id = 1;  ";

        $da =  Yii::$app->db->createCommand($sql)->queryAll();
        $data = $da[0];

        //单元格值
        $cell_arr = [
            'A1' => '采购合同',
            'H1' => "采购单号:$data[purchase_contract_no]\n创建时间:$data[purchaser]  2018-04-19 \n采购员:$data[purchaser]",
            'A2' => "采购方：$data[buy_company]\n地址:上海市浦东金穗路1055号1号楼3楼\n收货人:超级管理员\n联系人:胡球林\n电话:14782399401\n传真:",
            'F2' => "供货方: $data[factory]\n地址:\n联系人:\n电话:\n传真: ",
            'A3' => '交货日期：2018-04-30',
            'A4' => 'NO.',
            'B4' => 'SKU',
            'C4' => '开票品名',
            'D4' => '单位',
            'E4' => '单价(RMB)',
            'F4' => '数量(单位)',
            'G4' => '总金额(RMB)',
            'H4' => '税额',
            'I4' => '金额(RMB)',
            'J4' => '发票类型/税率',
            'K4' => '备注',
            'A5' => 1,
            'B5' => $data['sku'],
            'C5' => $data['product_name'],
            'D5' => $data['unit'],
            'E5' => $data['amount'],
            'F5' => $data['quantity'],
            'G5' => $data['amount'],
            'H5' => $data['amount'],
            'I5' => $data['amount'],
            'J5' => '专票 16%',
            'K5' =>'含税运',
            'A6' =>'产品合计体积：0.0000m³',
            'F6' =>'产品合计重量：0kg',
            'A7' =>"SKU种类:1\nSKU总数:100\n付款方式:电汇\n结算方式:款到发货",
            'F7' =>"合计金额（小写）:$data[amount] RMB",
            'F8' =>'合计金额（大写）:壹万壹仟叁佰叁拾元整',
            'A9' =>'供应商收款账号：',
            'F9' =>'麻烦贵司确认后，签字、盖章回传至我司，谢谢',
            'A11' =>'采购方代表(签字盖章):',
            'F11' =>'供方代表(签字盖章):',

        ];



        //设置合并单元格数组
        $mergeCells = ['A1:G1', 'H1:K1', 'A2:E2', 'F2:k2', 'A3:K3', 'A6:E6', 'F6:K6',
            'A7:E7','F7:K7','A8:E8','F8:K8','A9:E9','F9:K9','A10:K10','A11:E11','F11:K11'];
        foreach ($mergeCells as $k=>$v){
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($v);

        }

        $line = [1,2,7,11];
        $column = ['A','B','C', 'D','E','F','G','H','I','J','K',];

 //设置行高度
        foreach ($line as $v){
            $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($v)->setRowHeight(100);

        }
//设置列宽
        foreach ($column as $v){
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($v)->setWidth('7.29');

        }


        //设置单元格值
        foreach ($cell_arr as $k => $v) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($k, $v);
            $objPHPExcel->getActiveSheet()->getStyle("$k")->getAlignment()->setWrapText(true);

        }


//        设置默认的字体和文字大小     锚：aaa
        $objPHPExcel->getDefaultStyle()->getFont()->setName( 'Calibri');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);


//        文字对齐方式  锚：bbb
//$objPHPExcel->getActiveSheet()->getStyle( 'A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);    //水平方向上对齐
//$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);//水平方向上两端对齐
//$objPHPExcel->getActiveSheet()->getStyle( 'A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
$objPHPExcel->getActiveSheet()->getStyle( 'A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);       //垂直方向上中间居中
        //字体大小设置
//        /设置字体样式

//将B1的文字字体设置为Candara，20号的粗体下划线有背景色
$objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setName('SimSun' );
$objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setBold(true);


//        设置单元格边框  锚：bbb

        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'allborders' => array( //设置全部边框
                    'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                ),

            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:K11')->applyFromArray($styleThinBlackBorderOutline);
      /*  $border = ['A1:G1','H1:K1'];
        foreach ($border as $k=>$v){
            $objPHPExcel->getActiveSheet()->getStyle( "$v")->applyFromArray($styleThinBlackBorderOutline);

        }*/
        //数据结束
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="采购合同.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }


    function actionCny($ns) {

        static $cnums = ["零", "壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖"],
        $cnyunits = ["圆", "角", "分"],
        $grees = ["拾", "佰", "仟", "万", "拾", "佰", "仟", "亿"];
        list($ns1, $ns2) = explode(".", $ns, 2);
        $ns2 = array_filter(array($ns2[1], $ns2[0]));


        $ret = array_merge($ns2, array(implode("", $this->actionCny_map_unit(str_split($ns1), $grees)), ""));

        $ret = implode("", array_reverse($this->actionCny_map_unit($ret, $cnyunits)));
        return str_replace(array_keys($cnums), $cnums, $ret);
    }

    function actionCny_map_unit($list, $units) {
        $ul=count($units);
        $xs=array();
        foreach (array_reverse($list) as $x) {
            $l=count($xs);
            if ($x!="0" || !($l%4)) $n=($x=='0'?'':$x).($units[($l-1)%$ul]);
            else $n=is_numeric($xs[0][0])?$x:'';
            array_unshift($xs,$n);
        }
        return $xs;
    }

    public function actionSend( ){
        $objPHPExcel = new \PHPExcel();
        $sql = " SELECT  buy_company,factory,purchase_contract_no,product_name,unit,quantity,amount,declare_no,
                purchaser,sku  FROM new_contract where  id = 1;  ";

        $da =  Yii::$app->db->createCommand($sql)->queryAll();
        $data = $da[0];

        //单元格值
        $cell_arr = [
            'A1' => '广州澳沃司照明电器有限公司送货单',
            'A2' => "客户名称：上海商舟船舶用品有限公司",
            'A3' => "客户地址：上海市浦东新区金穗路1055号1号楼3楼 ",
            'A4' => '产品名称',
            'B4' => '规格型号',
            'C4' => '数量',
            'D4' => '单价',
            'E4' => '金额(RMB)',
            'F4' => '备注',
            'A5' => $data['product_name'],
            'B5' => $data['sku'],
            'C5' => $data['quantity'],
            'D5' => $data['amount'],
            'E5' => $data['amount'],
            'F5' => $data['purchase_contract_no'],
            'A7' =>'合计',
            'E7' =>"$data[amount]",
            'A9' =>'送货人:',
            'D9' =>'收货人:',

        ];
        //设置单元格值
        foreach ($cell_arr as $k => $v) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($k, $v);
            $objPHPExcel->getActiveSheet()->getStyle("$k")->getAlignment()->setWrapText(true);

        }

        //合并单元格
        //设置合并单元格数组
        $mergeCells = ['A1:F1','A2:F2','A3:F3', 'A9:C9', 'D9:F9' ];
        foreach ($mergeCells as $k=>$v){
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($v);

        }

        $column = ['A','B','C', 'D','E','F'];

        //设置行高度
        $objPHPExcel->setActiveSheetIndex(0)->getRowDimension(1)->setRowHeight(39);
        //设置列宽
        foreach ($column as $v){
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($v)->setWidth('10.5');

        }
        //        设置默认的字体和文字大小     锚：aaa
        $objPHPExcel->getDefaultStyle()->getFont()->setName( 'Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(16);

        //数据结束
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="送货单.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}
