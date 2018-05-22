<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pur_info".
 *
 * @property int $pur_info_id 主键
 * @property int $purchaser 负责人
 * @property int $pur_group 序号
 * @property string $pd_title 中文简称
 * @property string $pd_title_en 英文全称
 * @property string $pd_pic_url 图片
 * @property string $pd_package 外包装
 * @property string $pd_length 长cm
 * @property string $pd_width 宽cm
 * @property string $pd_height 高cm
 * @property int $is_huge 是否大件 0 否 1 是
 * @property string $pd_weight 货物实际重量kg
 * @property string $pd_throw_weight 抛重 长*宽*高/6000
 * @property string $pd_count_weight 计算重量
 * @property string $pd_material 材质
 * @property int $pd_purchase_num 申请采购数量
 * @property string $pd_pur_costprice 含税价格
 * @property int $has_shipping_fee 是否含运 0 否 1 是
 * @property string $bill_type 开票类型  --普票-- --16%专票-- --3%增票--
 * @property int $bill_tax_value 开票税率 --数字 并且小于16
 * @property int $hs_code HS编码
 * @property int $bill_tax_rebate 退税率
 * @property string $bill_rebate_amount 退税金额
 * @property string $no_rebate_amount 预计销售不退税价格RMB
 * @property string $retail_price 预计销售价格$
 * @property string $ebay_url eBay最低价链接
 * @property string $amazon_url amazon最低价链接
 * @property string $url_1688 1688最低价链接
 * @property string $shipping_fee 海运运费预估
 * @property string $oversea_shipping_fee 海外仓运运费预估
 * @property string $transaction_fee 成交费 销售金额的13%
 * @property string $gross_profit 预估毛利
 * @property string $remark 备注
 * @property int $parent_product_id 关联的母SKU ID
 */
class PurInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pur_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pur_group', 'pd_purchase_num', 'hs_code','parent_product_id',], 'integer'],
            [['pd_title','pd_title_en','pd_package','pd_length', 'pd_width', 'pd_height','pd_weight',
                'pd_pur_costprice','bill_tax_rebate','retail_price','pd_purchase_num','hs_code',
                'has_shipping_fee'], 'required'],
            [['pd_weight', 'pd_throw_weight', 'pd_count_weight', 'pd_pur_costprice'], 'number'],
            [['pd_title', 'pd_title_en', 'remark'], 'string', 'max' => 100],
            [['pd_pic_url', 'ebay_url', 'amazon_url', 'url_1688'], 'string', 'max' => 500],
            [['pd_package', 'pd_material'], 'string', 'max' => 1000],
            [['member','purchaser', 'pd_length', 'pd_width', 'pd_height', 'bill_type'], 'string', 'max' => 10],
            [['is_huge', 'has_shipping_fee'], 'string', 'max' => 1],
            [['bill_tax_value', 'bill_tax_rebate'], 'string', 'max' => 4],
            [['brocast_status','accept_status_pur','bill_rebate_amount', 'no_rebate_amount', 'retail_price', 'shipping_fee', 'oversea_shipping_fee', 'transaction_fee', 'gross_profit'], 'string', 'max' => 30],
            ['ebay_url','url','defaultScheme' => 'http'],
            ['amazon_url','url','defaultScheme' => 'http'],
            ['url_1688','url','defaultScheme' => 'http']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pur_info_id' => 'ID',
            'purchaser' => '采购人',
            'pur_group' => '序号',
            'pd_title' => '中文简称',
            'pd_title_en' => '英文全称',
            'pd_pic_url' => '图片',
            'pd_package' => '外包装',
            'pd_length' => '长(cm)',
            'pd_width' => '宽(cm)',
            'pd_height' => '高(cm)',
            'is_huge' => '是否是大件货',
            'pd_weight' => '货物实际重量kg',
            'pd_throw_weight' => '抛重',
            'pd_count_weight' => '计算重量',
            'pd_material' => '材质',
            'pd_purchase_num' => '申请采购数量',
            'pd_pur_costprice' => '含税价格',
            'has_shipping_fee' => '是否含运',
            'bill_type' => '开票类型',
            'bill_tax_value' => '开票税率',
            'hs_code' => 'HS编码',
            'bill_tax_rebate' => '退税率',
            'bill_rebate_amount' => '退税金额',
            'no_rebate_amount' => '预计销售不退税价格¥',
            'retail_price' => '预计销售价格$',
            'ebay_url' => 'eBay最低价链接',
            'amazon_url' => 'Amazon最低价链接',
            'url_1688' => '1688最低价链接',
            'shipping_fee' => '海运运费预估',
            'oversea_shipping_fee' => '海外仓运运费预估',
            'transaction_fee' => '成交费',
            'gross_profit' => '预估毛利',
            'remark' => '备注',
            'parent_product_id' => '父ID',
            'member' => '评审人',
            'accept_status_pur' => '接受状态',
            'brocast_status' => '公示状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * 一个产品有多个评论
     */
    public function getPreview()
    {
        //第一个参数为要关联的子表模型类名，
        //第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasMany(Preview::className(), ['product_id' => 'pur_info_id']);
    }




}
