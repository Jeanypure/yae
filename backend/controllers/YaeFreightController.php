<?php

namespace backend\controllers;

use backend\models\Company;
use backend\models\Purchaser;
use Yii;
use backend\models\YaeFreight;
use backend\models\FreightFee;
use backend\models\FeeCategory;
use backend\models\YaeExchangeRate;
use backend\models\FreightForwarders;
use backend\models\YaeFreightSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


use common\components\Upload;
use yii\web\Response;

use backend\models\UploadForm;
use yii\web\UploadedFile;

/**
 * YaeFreightController implements the CRUD actions for YaeFreight model.
 */
class YaeFreightController extends Controller
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
        $searchModel = new YaeFreightSearch();
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
        $param = $this->actionParam();

        if ($model->load(Yii::$app->request->post())) {
            $model->builder = Yii::$app->user->identity->username;
            //创建费用
            $res = $model->save(false);
            if ($res) {
                $fee_cat = Yii::$app->request->post()['YaeFreight']['fee_cateid'];
                $this->actionFee($model->id, $fee_cat);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'param' => $param,
           /* 'fee_category' => $param['name_zn'],
            'receiver' => $param['receiver'],
            'minister' => $param['minister'],*/
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
        $param = $this->actionParam();
        $total = Yii::$app->db->createCommand("SELECT 
                        CASE currency WHEN 1 THEN 'USD'
                        WHEN 2 THEN 'GBP' 
                        WHEN 3 THEN 'CAD' 
                        WHEN 4 THEN 'EUR' 
                        WHEN 5 THEN 'RMB'
                        ELSE '其他'
                        END AS currency, 
                         SUM(amount) as total
                        from freight_fee WHERE freight_id= $id
                        GROUP BY currency;
")->queryAll();
        $fee_model = FreightFee::find()->where(['freight_id' => $id])->all();
        if ($model->load(Yii::$app->request->post())) {
            $model->update_at = date('Y-m-d H:i:s');
            $model->save(false);
            return $this->redirect(['yae-freight/update', 'id' => $model->id]);
        }
        $query = FreightFee::find()->alias('e')
            ->leftJoin('fee_category y', 'e.description_id=y.id')
            ->select('e.*,y.name_zn')
            ->indexBy('id')->where(['freight_id' => $id]); // where `id` is your primary key

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->render('update', [
            'model' => $model,
            'param' => $param,
            'dataProvider' => $dataProvider,
            'fee_model' => $fee_model,
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
        $model = $this->findModel($id);
        if ($model->to_minister == 1) {
            echo 'error!';           //已提交不能删除1
        } else {
            $this->findModel($id)->delete();

        }

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


    public function actionFee($freight_id, $fee_cat)
    {
        $table = 'freight_fee';
        $arr_key = ['freight_id', 'description_id'];
        $arr = [];
        $freight_id = [$freight_id];
        foreach ($fee_cat as $key => $value) {
            $val = [$value];
            $new_array = array_merge($freight_id, $val);

            $arr[] = $new_array;

        }

        $res = $this->actionMultArray2Insert($table, $arr_key, $arr, $split = '`');

        $to_freight_fee = Yii::$app->db->createCommand($res)->execute();
        if ($to_freight_fee) {
            return 'success!';
        } else {
            return 'error!';
        }

    }

    public function actionCreateFee($id)
    {

        $model = new FreightFee();
        $param = $this->actionParam();
        if (isset($id) && !empty($id)) {
            $model->freight_id = $id;
            $model->save();
        }


        if ($model->load(Yii::$app->request->post())) {

            $quantity = Yii::$app->request->post()['FreightFee']['quantity'];
            $unit_price = Yii::$app->request->post()['FreightFee']['unit_price'];
            $model->amount = floatval($quantity) * floatval($unit_price);
            if ($model->save()) {
                return $this->redirect(['update', 'id' => $id]);

            }
        }

        return $this->renderAjax('create_fee', [
            'model' => $model,
            'fee_category' => $param['name_zn'],
            'currency' => $param['currency'],
        ]);

    }

    public function actionUpdateFee($id)
    {

        $model = FreightFee::find()->where(['id' => $id])->one();
        $param = $this->actionParam();
        if ($model->load(Yii::$app->request->post())) {
            $quantity = Yii::$app->request->post()['FreightFee']['quantity'];
            $unit_price = Yii::$app->request->post()['FreightFee']['unit_price'];
            $model->amount = floatval($quantity) * floatval($unit_price);
            if ($model->save()) {
                return $this->redirect(['update', 'id' => $model->freight_id]);
            }

        }

        return $this->renderAjax('update_fee', [
            'model' => $model,
            'fee_category' => $param['name_zn'],
            'currency' => $param['currency'],
        ]);
    }

    public function actionParam()
    {

        $fee_cate = FeeCategory::find()->select('id,name_zn')->asArray()->All();
        $cur = YaeExchangeRate::find()->select('id,currency')->asArray()->All();
        $forwarders = FreightForwarders::find()->select('id,receiver')->asArray()->All();
        $saler = Purchaser::find()->select('id,purchaser')->asArray()->where(['code'=>'freight_contact'])->All();
        $company = Company::find()->select('id,full_name')->asArray()->andWhere(['NOT', ['full_name' => null]])->All();
        $arr = [];
        $currency = [];
        $freight_for = [];
        $minister = [];
        $full_name = [];
        foreach ($fee_cate as $key => $value) {
            $arr[$value['id']] = $value['name_zn'];
        }
        foreach ($cur as $key => $value) {
            $currency[$value['id']] = $value['currency'];
        }
        foreach ($forwarders as $key => $value) {
            $freight_for[$value['id']] = $value['receiver'];
        }
        foreach ($saler as $key => $value) {
            $minister[$value['purchaser']] = $value['purchaser'];
        }
        foreach ($company as $key => $value) {
            $full_name[$value['id']] = $value['full_name'];
        }

        $param['name_zn'] = $arr;
        $param['currency'] = $currency;
        $param['receiver'] = $freight_for;
        $param['minister'] = $minister;
        $param['full_name'] = $full_name;
        return $param;
    }

    public function actionFeeDelete($id)
    {

        $feecat = FreightFee::find()->where(['id' => $id])->one();

        if ($feecat->delete()) {
            echo 1;
            Yii::$app->end();
        }
        echo 0;
        Yii::$app->end();

    }


    //webUploader上传
    public function actionUpload()
    {
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new Upload();
            $info = $model->upImage();
            if ($info && is_array($info)) {
                return $info;
            } else {
                return ['code' => 1, 'msg' => 'error'];
            }
        } catch (\Exception $e) {
            return ['code' => 1, 'msg' => $e->getMessage()];
        }
    }


    public function actionSubmit()
    {
        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k => $v) {
            $product_ids .= $v . ',';
        }
        $ids_str = trim($product_ids, ',');

        if (isset($ids) && !empty($ids)) {
            $res = Yii::$app->db->createCommand("
            update `yae_freight` set  to_minister = 1 where `id` in ($ids_str)
            ")->execute();
            if ($res) {
                echo 'success';
            }
        } else {
            echo 'error';
        }
    }


    public function actionCancel()
    {

        $ids = $_POST['id'];
        $product_ids = '';
        foreach ($ids as $k => $v) {
            $product_ids .= $v . ',';
        }
        $ids_str = trim($product_ids, ',');

        if (isset($ids) && !empty($ids)) {
            $res = Yii::$app->db->createCommand("
                       update `yae_freight` set  to_minister = 0 where `id` in ($ids_str)
            ")->execute();
            if ($res) {
                echo 'success';
            }
        } else {
            echo 'error';
        }
    }


    /**
     * 多条数据同时转化成插入SQL语句
     * @ CreatBy:IT自由职业者
     * @param string $table 表名
     * @$arr_key是表字段名的key：$arr_key=array("field1","field2","field3")
     * @param array $arr是字段值 数组示例 arrat(("a","b","c"), ("bbc","bbb","caaa"),('add',"bppp","cggg"))
     * @return string
     */

    public function actionMultArray2Insert($table, $arr_key, $arr, $split = '`')
    {

        $arrValues = array();

        if (empty($table) || !is_array($arr_key) || !is_array($arr)) {

            return false;

        }

        $sql = "INSERT INTO %s( %s ) values %s ";

        foreach ($arr as $k => $v) {

            $arrValues[$k] = "'" . implode("','", array_values($v)) . "'";

        }

        $sql = sprintf($sql, $table, "{$split}" . implode("{$split} ,{$split}", $arr_key) . "{$split}", "(" . implode(") , (", array_values($arrValues)) . ")");

        return $sql;

    }


    public function actionExport($id = null)
    {
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
               case t.receiver when 1 then '深圳大森林国际货代有限公司'
               when 2 then '上海珑瑗国际货物运输代理有限公司'
               when 3 then '上海昊宏国际货物运输代理有限公司'
               when 4 then '深圳市安泰克物流有限公司'
               when 5 then '文鼎供应链管理(上海)有限公司'
               else t.receiver end  as receiver,
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

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $company = Yii::$app->db->createCommand("select sub_company,memo from company")->queryAll();
        $company_arr = [];
        foreach ($company as $key => $val) {
            $company_arr[$val['sub_company']] = $val['memo'];
        }

        //设置表格头的输出
        foreach ($header as $key => $value) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$key", "$value");
        }
        foreach ($data as $k => $v) {
            $num = 2;
            $num = $num + $k;
            $objPHPExcel->setActiveSheetIndex(0)
                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                ->setCellValue('A' . $num, $company_arr[$v['bill_to']])
                ->setCellValue('B' . $num, $v['receiver'])
                ->setCellValue('C' . $num, $v['contract_no'])
                ->setCellValue('D' . $num, $v['debit_no'])
                ->setCellValue('E' . $num, $v['RMB'])
                ->setCellValue('F' . $num, $v['USD'])
                ->setCellValue('G' . $num, $v['CAD'])
                ->setCellValue('H' . $num, $v['GBP'])
                ->setCellValue('I' . $num, $v['EUR']);
        }

        //汇总项
        $sum = count($data) + 2;
        $v = count($data) + 1;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D' . $sum, '汇总')
            ->setCellValue('E' . $sum, "=SUM(E2:E{$v})")
            ->setCellValue('F' . $sum, "=SUM(F2:F{$v})")
            ->setCellValue('G' . $sum, "=SUM(G2:G{$v})")
            ->setCellValue('H' . $sum, "=SUM(H2:H{$v})")
            ->setCellValue('I' . $sum, "=SUM(I2:I{$v})");

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
