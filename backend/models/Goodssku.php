<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goodssku}}".
 *
 * @property int $sku_id 产品ID
 * @property string $sku
 * @property string $pd_title 产品名称
 * @property string $pd_title_en 产品英文名称
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
class Goodssku extends yii\db\ActiveRecord
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
            [['audit_result','has_toeccang','has_tons','has_commit','is_quantity_check', 'contain_battery', 'qty_of_ctn', 'min_order_num', 'pd_get_days', 'pur_info_id'], 'integer'],
            [['material','use','sku', 'old_sku','hs_code'], 'string', 'max' => 60],
            [['currency_code', 'bill_unit'], 'string', 'max' => 5],
            [[ 'brand', 'sku_mark'], 'string', 'max' => 100],
            [['vendor_code', 'pd_costprice_code'], 'string', 'max' => 30],
            [['origin_code'], 'string', 'max' => 1000],
            [['bill_name'], 'string', 'max' => 50],
            [['declaration_item_key6','declaration_item_key7','declaration_item_key8','declaration_item_key9',], 'string', 'max' => 100],
            [['declaration_item_value6','declaration_item_value7','declaration_item_value8','declaration_item_value9',], 'string', 'max' => 30],
            [['pd_title', 'pd_title_en'], 'string', 'max' => 300],
            [['pd_length','pd_width','pd_height','pd_weight','pd_creator',], 'string', 'max' =>10 ],
            [['image_url'], 'string', 'max' =>500 ],
            [['audit_content','sale_company','sku_create_date','sku_update_date' ], 'safe'],
            [['sku','pd_title','pd_title_en','image_url','is_quantity_check','pd_costprice','declared_value','contain_battery',
                'pd_length','pd_width','pd_height','pd_weight','sale_company','hs_code',
                'declaration_item_key1','declaration_item_key2','declaration_item_key3','declaration_item_key4','declaration_item_key5',
                'declaration_item_value1','declaration_item_value2','declaration_item_value3','declaration_item_value4','declaration_item_value5',
                'material','use','bill_img1_name_unit','bill_img1'
            ], 'required'],



        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sku_id' => 'Sku ID',
            'sku' => 'SKU',
            'declared_value' => '申报价值(USD)',
            'currency_code' => '申报币种',
            'old_sku' => '曾用SKU',
            'is_quantity_check' => '是否需要质检',
            'contain_battery' => '是否包含电池',
            'qty_of_ctn' => '单箱数量',
            'ctn_length' => '箱长',
            'ctn_width' => '箱宽',
            'ctn_height' => '箱高',
            'ctn_fact_weight' => '单箱实际重量',
            'sale_company' => '销售公司',
            'vendor_code' => '默认供应商代码',
            'origin_code' => '供应商规格型号',
            'min_order_num' => '最少起订量',
            'pd_get_days' => '预估交期(天)',
            'pd_costprice_code' => '采购币种',
            'pd_costprice' => '采购价',
            'bill_name' => '开票品名',
            'bill_unit' => '开票单位',
            'brand' => '产品品牌',
            'sku_mark' => '备注',
            'pur_info_id' => 'Pur Info ID',
            'pd_title' => '产品名称',
            'pd_title_en' => '产品英文名称',
            'pd_length' => '长cm',
            'pd_width' => '宽cm',
            'pd_height' => '高cm',
            'pd_weight' => '产品重量(kg)',
            'pd_creator' => '产品开发人员',
            'image_url' => '图片地址',
            'sku_create_date' => '创建档案时间',
            'sku_update_date' => '更新档案时间',
            'has_commit' => '是否提交',
            'has_toeccang' => '是否导易仓',
            'has_tons' => '是否导NS',
            'audit_result' => '是否通过',
            'audit_content' => '审核内容',
            'hs_code' => 'HS编码',
            'declaration_item_key1' => '要素名0',
            'declaration_item_value1' => '要素值0',
            'declaration_item_key2' => '要素名1',
            'declaration_item_value2' => '要素值1',
            'declaration_item_key3' => '要素名2',
            'declaration_item_value3' => '要素值2',
            'declaration_item_key4' => '要素名3',
            'declaration_item_value4' => '要素值3',
            'declaration_item_key5' => '要素名4',
            'declaration_item_value5' => '要素值4',
            'declaration_item_key6' => '要素名5',
            'declaration_item_value6' => '要素值5',
            'declaration_item_key7' => '要素名6',
            'declaration_item_value7' => '要素值6',
            'declaration_item_key8' => '要素名7',
            'declaration_item_value8' => '要素值7',
            'declaration_item_key9' => '要素名8',
            'declaration_item_value9' => '要素值8',
            'material' => '材质',
            'use' => '用途',
            'bill_img1_name_unit' => '发票01的开票品名和单位',
            'bill_img1' => '发票照片',
            'bill01_img_add' => '发票照片地址',
        ];


    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    /*'updatedAtAttribute' => 'sku_update_date',
                    'createdByAttribute' => 'sku_create_date',*/
                    # 创建之前
                    ActiveRecord::EVENT_BEFORE_INSERT => ['sku_create_date', 'sku_update_date'],
                    # 修改之前
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['sku_update_date']
                ],
                #设置默认值
                'value' =>new Expression('NOW()')
            ]
        ];
    }
}
