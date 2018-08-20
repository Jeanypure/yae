<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%sku_vendor}}".
 *
 * @property int $id 记录ID
 * @property int $sku_id SKUID
 * @property string $vendor_code 供应商代码
 * @property string $origin_code 供应商产品规格型号
 * @property int $min_order_num 最少起订量
 * @property int $pd_get_days 交期
 * @property string $pd_costprice_code 采购币种
 * @property string $pd_costprice 采购价
 * @property string $bill_unit 开票单位 EA(单个) KG(公斤) MT(米) CASE(盒) PC(件) SET(套)
 * @property string $brand 产品品牌
 * @property string $create_date 创建时间
 * @property string $update_date 修改时间
 * @property string $remark 备注
 */
class SkuVendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sku_vendor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku_id', 'min_order_num', 'pd_get_days'], 'integer'],
            [['pd_costprice'], 'number'],
            [['create_date', 'update_date'], 'safe'],
            [['vendor_code', 'origin_code'], 'string', 'max' => 20],
            [['pd_costprice_code'], 'string', 'max' => 30],
            [['bill_unit'], 'string', 'max' => 5],
            [['brand', 'remark'], 'string', 'max' => 100],
            [['bill_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku_id' => 'Sku ID',
            'vendor_code' => '供应商代码',
            'origin_code' => '供应商产品规格型号',
            'min_order_num' => '最少起订量',
            'pd_get_days' => '预估交期(天)',
            'pd_costprice_code' => '采购币种',
            'pd_costprice' => '采购价',
            'bill_name' => '开票品名',
            'bill_unit' => '开票单位',
            'brand' => '产品品牌',
            'create_date' => '创建日期',
            'update_date' => '更新日期',
            'remark' => '备注',
        ];
    }
}
