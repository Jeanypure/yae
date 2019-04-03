<?php

namespace backend\modules\cost\models;

use Yii;

/**
 * This is the model class for table "{{%cost_tongtool_bill}}".
 *
 * @property int $id ID
 * @property string $bill_no 账单编号
 * @property string $amount RMB金额
 * @property string $born_date 生成日期
 * @property string $status 状态
 * @property string $payment_platform 支付平台
 * @property string $department 公司
 */
class CostTongtoolBill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cost_tongtool_bill}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['bill_no', 'status', 'department'], 'string', 'max' => 20],
            [['born_date'], 'string', 'max' => 10],
            [['payment_platform'], 'string', 'max' => 60],
            [['bill_no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_no' => '账单编号',
            'amount' => 'RMB金额',
            'born_date' => '生成日期',
            'status' => '状态',
            'payment_platform' => '支付平台',
            'department' => '公司',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CostTongtoolBillQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CostTongtoolBillQuery(get_called_class());
    }
}
