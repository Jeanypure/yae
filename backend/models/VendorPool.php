<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%vendor_pool}}".
 *
 * @property int $id ID
 * @property string $supplier_code 供应商简称代码
 * @property string $supplier_name 供应商名称
 */
class VendorPool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vendor_pool}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_code'], 'string', 'max' => 32],
            [['supplier_name'], 'string', 'max' => 64],
            [['supplier_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_code' => 'Supplier Code',
            'supplier_name' => '供应商名字',
        ];
    }
}
