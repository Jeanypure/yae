<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%tb_vendor_list}}".
 *
 * @property int $id ID
 * @property string $internal_id 供应商内部
 * @property string $vendor_code 供应商代码
 * @property string $vendor_name 供应商公司名
 * @property string $datecreated
 */
class VendorList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_vendor_list}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datecreated'], 'safe'],
            [['internal_id'], 'string', 'max' => 11],
            [['vendor_code', 'vendor_name'], 'string', 'max' => 100],
            [['vendor_code', 'vendor_name'], 'unique', 'targetAttribute' => ['vendor_code', 'vendor_name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'internal_id' => 'Internal ID',
            'vendor_code' => 'Vendor Code',
            'vendor_name' => 'Vendor Name',
            'datecreated' => 'Datecreated',
        ];
    }
}
