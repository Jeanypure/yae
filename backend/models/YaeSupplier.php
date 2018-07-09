<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%yae_supplier}}".
 *
 * @property int $id 供应商ID
 * @property string $supplier_code 供应商简称代码
 * @property string $supplier_name 供应商名称
 * @property string $pd_bill_name 开票品名
 * @property string $bill_unit 开票单位
 * @property string $submitter 资料提交人
 * @property int $bill_type 开票类型 0 16%专票 1 3%专票 2 增值税普通发票
 * @property string $business_licence 供应商执照
 * @property string $bank_account_data 银行开户资料
 * @property string $pay_card 收款卡号
 * @property string $pay_name 收款人名称
 * @property string $pay_bank 收款银行备注,填写银行名称，支行名称
 * @property string $sup_remark 注意事项
 */
class YaeSupplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%yae_supplier}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bill_type'], 'integer'],
            [['supplier_code', 'bill_unit', 'submitter'], 'string', 'max' => 32],
            [['supplier_name', 'pd_bill_name'], 'string', 'max' => 64],
            [['business_licence', 'bank_account_data'], 'string', 'max' => 200],
            [['pay_card', 'pay_name', 'pay_bank'], 'string', 'max' => 128],
            [['sup_remark'], 'string', 'max' => 256],
            [['supplier_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_code' => '供应商代码',
            'supplier_name' => '供应商名称',
            'pd_bill_name' => '开票品名',
            'bill_unit' => '开票单位',
            'submitter' => '资料提交人',
            'bill_type' => '开票类型',
            'business_licence' => '供应商执照',
            'bank_account_data' => '银行开户资料',
            'pay_card' => '收款卡号',
            'pay_name' => '收款人名称',
            'pay_bank' => '支行名称',
            'sup_remark' => '注意事项',
        ];
    }
}
