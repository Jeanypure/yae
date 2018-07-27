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

        //2018 6-1号之前全部按17,6月1号之后全部按16
        $date = '';
        if($date > '2018-06-01'){
            $rate = 0.16;
            $bill_type = '专票 16%';
        }else{
            $rate = 0.17;
            $bill_type = '专票 17%';

        }
        $upAmount =  $this->actionNumToRmb($data['amount']);
        $price =  sprintf("%.2f",$data['amount']/$data['quantity']) ; //单价
        $tax = sprintf("%.2f",$data['amount']* $rate) ; //税额
        $no_tax_amount = $data['amount'] - $tax;

        //单元格值
        $cell_arr = [
            'A1' => '采购合同',
            'H1' => "采购单号:$data[purchase_contract_no]\n创建时间:$data[purchaser]  2018-04-19 \n采购员:$data[purchaser]",
            'A2' => "采购方:$data[buy_company]\n地址:上海市浦东金穗路1055号1号楼3楼\n收货人:超级管理员\n联系人:胡球林\n电话:14782399401\n传真:",
            'F2' => "供货方: $data[factory]\n地址:\n联系人:\n电话:\n传真: ",
            'A3' => '交货日期:2018-04-30',
            'A4' => 'NO.',
            'B4' => '开票品名',
            'C4' => '单位',
            'D4' => '单价￥',
            'E4' => '数量',
            'F4' => '金额￥',
            'G4' => '税额￥',
            'H4' => '总金额￥',
            'I4' => '发票类型/税率',
            'J4' => '备注',
            'A5' => 1,
            'B5' => $data['product_name'],
            'C5' => $data['unit'],
            'D5' => $price,
            'E5' => $data['quantity'],
            'F5' => $no_tax_amount,
            'G5' => $tax,
            'H5' => $data['amount'],
            'I5' => $bill_type,
            'J5' => '含税运',
            'A6' =>"付款方式:电汇结算方式:款到发货",
            'F6' =>"合计金额（小写）:$data[amount]￥",
            'F7' =>"合计金额（大写）:$upAmount",
            'A8' =>'供应商收款账号:',
            'F8' =>'麻烦贵司确认后，签字、盖章回传至我司,谢谢',
            'A10' =>'采购方代表(签字盖章):',
            'F10' =>'供方代表(签字盖章):',

        ];
        $line = [1=>'100',2=>'100',6=>'66',10=>'100'];
        $column = ['A','B','C', 'D','E','F','G','H','I','J'];

        //设置行高度
        foreach ($line as $k=>$v){
            $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($k)->setRowHeight($v);
        }


        //设置列宽
        foreach ($column as $v){
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($v)->setWidth('9');
        }
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth('13');

        //设置单元格值
        foreach ($cell_arr as $k => $v) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($k, $v);
            $objPHPExcel->getActiveSheet()->getStyle("$k")->getAlignment()->setWrapText(true);

        }


        //文字对齐方式  锚:bbb
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    //水平方向上对齐
        //对齐
        $objPHPExcel->getActiveSheet()->getStyle( 'F9')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle( 'A10')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

        $objPHPExcel->getActiveSheet()->getStyle( 'F10')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

        $objPHPExcel->getActiveSheet()->getStyle( 'A3')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
        $objPHPExcel->getActiveSheet()->getStyle( 'A3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $objPHPExcel->getActiveSheet()->getStyle( 'A4:J7')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle( 'A4:J7')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);



        //将B1的文字字体设置为Candara，20号的粗体下划线有背景色
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setName('SimSun' );
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setSize(20);
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle( 'A2:F10')->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle( 'A4:J4')->getFont()->setName('SimSun' )->setSize(10)->setBold(true);


        //设置合并单元格数组
        $mergeCells = ['A1:G1', 'H1:J1', 'A2:E2', 'F2:J2', 'A3:J3', 'A6:E6', 'F6:J6',
            'A7:E7','F7:J7','A8:E8','F8:J8','A9:E9','F9:J9','A10:E10','F10:J10'];
        foreach ($mergeCells as $k=>$v){
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($v);
        }

        // 设置单元格边框

        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'allborders' => array( //设置全部边框
                    'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                ),


            ),
        );
        $Outline = array(
            'borders' => array(
                'outline' => array( //设置全部边框
                    'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                ),


            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle( 'A2:J10')->applyFromArray($styleThinBlackBorderOutline);
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:J1')->applyFromArray($Outline);

        //数据结束
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="采购合同.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }


    /**
     *数字金额转换成中文大写金额的函数
     *String Int  $num  要转换的小写数字或小写字符串
     *return 大写字母
     *小数位为两位
     **/
    function actionNumToRmb($num){
        $c1 = "零壹贰叁肆伍陆柒捌玖";
        $c2 = "分角元拾佰仟万拾佰仟亿";
        //精确到分后面就不要了，所以只留两个小数位
        $num =round($num, 2);
        //将数字转化为整数
        $num = $num * 100;
        if (strlen($num) > 10) {
            return "金额太大，请检查";
        }


        $i = 0;
        $c = "";
        while (1) {
            if ($i == 0) {
                //获取最后一位数字
                $n = substr($num, strlen($num)-1, 1);
            } else {
                $n = $num % 10;
            }
            //每次将最后一位数字转化为中文
            $p1 = substr($c1, 3 * $n, 3);
            $p2 = substr($c2, 3 * $i, 3);
            if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
                $c = $p1 . $p2 . $c;
            } else {
                $c = $p1 . $c;
            }
            $i = $i + 1;
            //去掉数字最后一位了
            $num = $num / 10;
            $num = (int)$num;
            //结束循环
            if ($num == 0) {
                break;
            }
        }
        $j = 0;
        $slen = strlen($c);
        while ($j < $slen) {
            //utf8一个汉字相当3个字符
            $m = substr($c, $j, 6);
            //处理数字中很多0的情况,每次循环去掉一个汉字“零”
            if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
                $left = substr($c, 0, $j);
                $right = substr($c, $j + 3);
                $c = $left . $right;
                $j = $j-3;
                $slen = $slen-3;
            }
            $j = $j + 3;
        }
        //这个是为了去掉类似23.0中最后一个“零”字
        if (substr($c, strlen($c)-3, 3) == '零') {
            $c = substr($c, 0, strlen($c)-3);
        }
        //将处理的汉字加上“整”
        if (empty($c)) {
            return "零元整";
        }else{
            return $c . "整";
        }
    }



    public function actionSend( ){
        $objPHPExcel = new \PHPExcel();
        $sql = " SELECT  buy_company,factory,purchase_contract_no,product_name,unit,quantity,amount,declare_no,
                purchaser,sku  FROM new_contract where  id = 1;  ";

        $da =  Yii::$app->db->createCommand($sql)->queryAll();
        $data = $da[0];
        //2018前 老地址   后新地址
        $date = '';
        if($date > '2018-01-01'){
            $address = '上海市浦东新区金穗路1055号1号楼3楼';
        }else{
            $address = '中国（上海）自由贸易试验区金豫路100号1幢325室';
        }
        
        //单元格值
        $cell_arr = [
            'A1' => "$data[factory]送货单",
            'A2' => "客户名称:$data[buy_company]",
            'A3' => "客户地址:$address",
            'A4' => '产品名称',
            'B4' => '数量',
            'C4' => '单价',
            'D4' => '金额￥',
            'E4' => '备注',
            'A5' => $data['product_name'],
            'B5' => $data['quantity'],
            'C5' => $data['amount'],
            'D5' => $data['amount'],
            'E5' => $data['purchase_contract_no'],
            'A7' =>'合计',
            'D7' =>"$data[amount]",
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

        $column = ['A','B','C', 'D','E'];
        $row = [1=>'39',2=>'24',3=>'24',4=>'39',5=>'39',6=>'24',7=>'24',8=>'24'];

        //设置行高度
        foreach ($row as $k=>$v){
            $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($k)->setRowHeight($v);

        }

        //设置列宽
        foreach ($column as $v){
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($v)->setWidth('11.5');

        }

        //        文字对齐方式  锚:bbb
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);       //垂直方向上中间居中
        //        设置默认的字体和文字大小     锚:aaa
        $objPHPExcel->getDefaultStyle()->getFont()->setName( 'Calibri');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
        $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle( 'A4:F7')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle( 'A4:F7')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);


        //        设置单元格边框  锚:bbb

        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'allborders' => array( //设置全部边框
                    'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                ),

            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:F9')->applyFromArray($styleThinBlackBorderOutline);

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
