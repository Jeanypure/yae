<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%vendor_detail_copy}}".
 *
 * @property int $id 供应商ID
 * @property string $internalid NS供应商内部ID
 * @property string $supplier_code 供应商简称代码
 * @property string $supplier_name 供应商名称
 * @property string $contact_qq 联系姓名
 * @property string $contact_tel 联系电话
 * @property string $contact_name QQ
 * @property string $bill_type 开票类型 0 16%专票  1增值税普通发票  2  3%专票
 * @property string $date_create 创建日期
 * @property string $date_update 更新时间
 * @property string $arrival_date 到货日期
 * @property int $payment_method 票款顺序 付款方式 1 票到付款  2 先预付再开票再付尾款  3 先付款后开票
 */
class VendorDetailCopy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vendor_detail_copy}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['payment_method'], 'integer'],
            [['internalid'], 'string', 'max' => 11],
            [['supplier_code', 'contact_tel', 'contact_name'], 'string', 'max' => 32],
            [['supplier_name'], 'string', 'max' => 64],
            [['contact_qq'], 'string', 'max' => 16],
            [['bill_type'], 'string', 'max' => 30],
            [['arrival_date'], 'string', 'max' => 10],
            [['supplier_code'], 'unique'],
            [['supplier_name'], 'unique'],
            [['supplier_code', 'supplier_name'], 'unique', 'targetAttribute' => ['supplier_code', 'supplier_name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'internalid' => 'Internalid',
            'supplier_code' => 'Supplier Code',
            'supplier_name' => 'Supplier Name',
            'contact_qq' => 'Contact Qq',
            'contact_tel' => 'Contact Tel',
            'contact_name' => 'Contact Name',
            'bill_type' => 'Bill Type',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'arrival_date' => 'Arrival Date',
            'payment_method' => 'Payment Method',
        ];
    }
}
