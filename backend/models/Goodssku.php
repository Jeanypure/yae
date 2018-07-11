<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%goodssku}}".
 *
 * @property int $sku_id 产品ID
 * @property string $sku
 * @property string $declared_value 申报价值
 * @property string $currency_code 申报币种
 * @property string $old_sku 曾用SKU
 * @property int $is_quantity_check 0:不质检;1:质检
 * @property int $contain_battery 含电池:  0,不含 1:含
 * @property int $qty_of_ctn 单箱数量
 * @property string $ctn_length 箱长
 * @property string $ctn_width 箱宽
 * @property string $ctn_height 箱高
 * @property string $ctn_fact_weight 单箱实际重量(KG)
 * @property string $sale_company 销售公司
 * @property string $vendor_code 默认供应商代码
 * @property string $origin_code 供应商品号 供应商规格型号
 * @property int $min_order_num 最少起订量
 * @property int $pd_get_days 交期
 * @property string $pd_costprice_code 采购币种
 * @property string $pd_costprice 采购价
 * @property string $bill_name 开票品名
 * @property string $bill_unit 开票单位 EA(单个) KG(公斤) MT(米) CASE(盒) PC(件) SET(套)
 * @property string $brand 产品品牌
 * @property string $sku_mark 备注
 * @property int $pur_info_id pur_info_id表主键
 */
class Goodssku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%goodssku}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['declared_value', 'ctn_length', 'ctn_width', 'ctn_height', 'ctn_fact_weight', 'pd_costprice'], 'number'],
            [['is_quantity_check', 'contain_battery', 'qty_of_ctn', 'min_order_num', 'pd_get_days', 'pur_info_id'], 'integer'],
            [['sku', 'old_sku'], 'string', 'max' => 60],
            [['currency_code', 'bill_unit'], 'string', 'max' => 5],
            [['sale_company', 'brand', 'sku_mark'], 'string', 'max' => 100],
            [['vendor_code', 'pd_costprice_code'], 'string', 'max' => 30],
            [['origin_code'], 'string', 'max' => 216],
            [['bill_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sku_id' => 'Sku ID',
            'sku' => 'Sku',
            'declared_value' => 'Declared Value',
            'currency_code' => 'Currency Code',
            'old_sku' => 'Old Sku',
            'is_quantity_check' => 'Is Quantity Check',
            'contain_battery' => 'Contain Battery',
            'qty_of_ctn' => 'Qty Of Ctn',
            'ctn_length' => 'Ctn Length',
            'ctn_width' => 'Ctn Width',
            'ctn_height' => 'Ctn Height',
            'ctn_fact_weight' => 'Ctn Fact Weight',
            'sale_company' => 'Sale Company',
            'vendor_code' => 'Vendor Code',
            'origin_code' => 'Origin Code',
            'min_order_num' => 'Min Order Num',
            'pd_get_days' => 'Pd Get Days',
            'pd_costprice_code' => 'Pd Costprice Code',
            'pd_costprice' => 'Pd Costprice',
            'bill_name' => 'Bill Name',
            'bill_unit' => 'Bill Unit',
            'brand' => 'Brand',
            'sku_mark' => 'Sku Mark',
            'pur_info_id' => 'Pur Info ID',
        ];
    }
}
