<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%supplier_contact}}".
 *
 * @property int $contact_id 联系ID,一个供应商存在多个联系人
 * @property int $supplier_id 供应商序列ID
 * @property string $contact_name 联系姓名
 * @property string $contact_tel 联系电话
 * @property string $contact_address 联系地址
 * @property string $contact_qq QQ
 * @property string $contact_wechat 微信
 * @property string $contact_wangwang 旺旺
 * @property string $contact_memo 备注
 */
class SupplierContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%supplier_contact}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_id'], 'integer'],
            [['contact_name', 'contact_tel'], 'string', 'max' => 32],
            [['contact_address'], 'string', 'max' => 216],
            [['contact_qq'], 'string', 'max' => 16],
            [['contact_wechat', 'contact_wangwang', 'contact_memo', 'skype'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => 'Contact ID',
            'supplier_id' => 'Supplier ID',
            'contact_name' => '联系人',
            'contact_tel' => '联系电话',
            'contact_address' => '中文联系地址',
            'contact_qq' => 'QQ',
            'contact_wechat' => '微信',
            'contact_wangwang' => '旺旺',
            'skype' => 'Skype',
            'contact_memo' => '备注',
        ];
    }
}
