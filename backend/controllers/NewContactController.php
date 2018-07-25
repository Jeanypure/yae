<?php

namespace backend\controllers;
use Yii;

class NewContactController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
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
/*        $sql = "
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
                WHERE t.id IN (1)
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
        }*/

        //设置表格头的输出
//        foreach($header as $key=>$value){
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$key", "$value");
//        }

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '采购合同');
        /*foreach ($data as $k =>$v){
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
        }*/

        //汇总项
       /* $sum  = count($data) + 2;
        $v  = count($data) + 1;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D'.$sum, '汇总')
            ->setCellValue('E'.$sum, "=SUM(E2:E{$v})")
            ->setCellValue('F'.$sum, "=SUM(F2:F{$v})")
            ->setCellValue('G'.$sum, "=SUM(G2:G{$v})")
            ->setCellValue('H'.$sum, "=SUM(H2:H{$v})")
            ->setCellValue('I'.$sum, "=SUM(I2:I{$v})") ;*/

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
