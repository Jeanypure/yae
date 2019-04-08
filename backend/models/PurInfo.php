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
 * @property string $retail_price 预计售价$
 * @property string $ebay_url eBay链接
 * @property string $amazon_url amazon链接
 * @property string $url_1688 1688链接
 * @property string $shipping_fee 海运运费预估
 * @property string $oversea_shipping_fee 海外仓运运费预估
 * @property string $transaction_fee 成交费 销售金额的13%
 * @property string $gross_profit 预估毛利¥
 * @property string $remark 备注
 * @property int $parent_product_id 关联的母SKU ID
 */
class PurInfo extends \yii\db\ActiveRecord
{
    public $view_status;
    public $submit_manager;
    public $result;
    public  $spur_info_id;
    public  $is_agreest;
    public  $create_date;
    public  $pay_amount;
    public  $has_arrival;
    public  $minister_result;
    public  $write_date;
    public  $unit_price;
    public  $weight;
    public  $grade;
    public  $audit_team_result;
    public  $purchaser_result;
    public  $is_diff;
    public  $pd_sku,$pay_way;


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
            [['is_purchase','trading_company','source','brocast_status','is_quality','sample_submit1','sample_submit2','pur_complete_status','is_assign','junior_submit', 'pd_purchase_num', 'parent_product_id','preview_status'], 'integer'],
            [['trading_company','bill_name','bill_unit','bill_type','pd_title','pd_title_en','pd_package','pd_length', 'pd_width', 'pd_height','pd_weight',
                'pd_pur_costprice','bill_tax_rebate','retail_price','pd_purchase_num','hs_code',
                'has_shipping_fee','is_patent_right','is_third_party_abroad_right','promise_rights','special_auth_FDA'], 'required'],
            [['pd_weight', 'pd_throw_weight', 'pd_count_weight', 'pd_pur_costprice',
                'bill_rebate_amount', 'no_rebate_amount', 'retail_price', 'shipping_fee',
                'amz_retail_price',
               'fact_pay_amount', 'amz_retail_price_rmb','selling_on_amz_fee','amz_fulfillment_cost','ams_logistics_fee','gross_profit_amz','profit_rate_amz', 'profit_rate','oversea_shipping_fee', 'transaction_fee', 'gross_profit'], 'number'],
            [['hs_code','master_result','pd_title', 'pd_title_en', 'remark'], 'string', 'max' => 500],
            [['master_mark','pd_pic_url', 'ebay_url', 'amazon_url', 'url_1688','else_url'], 'string', 'max' => 2000],
            [['pd_package', 'pd_material'], 'string', 'max' => 1000],
            [['member','purchaser','pd_length', 'pd_width','pd_height','bill_type'], 'string', 'max' => 10],
            [['is_submit_manager','is_submit','is_huge', 'has_shipping_fee'], 'string', 'max' => 1],
            [[ 'bill_tax_rebate'], 'string', 'max' => 4],
            [['new_member'], 'string', 'max' => 30],
            ['ebay_url','url','defaultScheme' => 'http'],
            ['amazon_url','url','defaultScheme' => 'http'],
            ['else_url','url','defaultScheme' => 'http'],
            ['url_1688','url','defaultScheme' => 'http'],
            [['pd_sku','pd_create_time','write_date','purchaser_send_time','sure_purchase_time','pur_group'], 'safe'],
            [['sample_return', ], 'integer'],
            [['hs_code'],'match','pattern'=>'^\d{10}$','message'=>'请输入正确的HS编码'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pur_info_id' => 'ID',
            'audit_a' => '审核组',
            'audit_b' => '部长组',
            'is_assign' => '是否分配',
            'purchaser' => '采购人',
            'pur_group' => '部门号',
            'pd_title' => '中文简称',
            'pd_title_en' => '英文全称',
            'pd_pic_url' => '图片地址',
            'pd_package' => '外包装',
            'pd_length' => '长(cm)',
            'pd_width' => '宽(cm)',
            'pd_height' => '高(cm)',
            'is_huge' => '是否大件',
            'pd_weight' => '货物实际重量kg',
            'pd_throw_weight' => '抛重',
            'pd_count_weight' => '计算重量',
            'pd_material' => '材质',
            'pd_purchase_num' => '申请采购数量',
            'pd_pur_costprice' => '含税价格¥',
            'has_shipping_fee' => '是否含运',
            'bill_type' => '开票类型',
            'bill_name' => '开票品名',
            'bill_unit' => '开票单位',
            'hs_code' => 'HS编码',
            'bill_tax_rebate' => '退税率%',
            'bill_rebate_amount' => '退税金额¥',
            'no_rebate_amount' => 'eBay预计销售价¥',
            'retail_price' => 'eBay预计售价$',
            'ebay_url' => 'eBay低价链接',
            'amazon_url' => 'Amazon低价链接',
            'url_1688' => '1688低价链接',
            'shipping_fee' => '海运运费预估¥',
            'oversea_shipping_fee' => '海外仓运运费预估¥',
            'transaction_fee' => '成交费¥',
            'gross_profit' => 'eBay预估毛利¥',
            'remark' => '备注',
            'parent_product_id' => '父ID',
            'member' => '评审人',
            'preview_status' => '评审状态',
            'brocast_status' => '公示状态',
            'master_result' => '经理评审',
            'master_mark' => '评审意见',
            'ams_logistics_fee' => 'amz物流计算费用$',
            'is_submit' => '提交状态',
            'is_submit_manager' => '评审提交',
            'else_url' => '其他链接',
            'view_status' => '评审状态',
            'pd_create_time' => '创建时间',
            'junior_submit' => '是否提交',
            'profit_rate' => 'eBay毛利率%',
            'gross_profit_amz' => 'Amazon毛利¥',
            'profit_rate_amz' => 'Amazon毛利率%',
            'selling_on_amz_fee' => 'Selling on Amazon fees',
            'amz_fulfillment_cost' => 'Total Fulfillment Cost',
            'amz_retail_price' => 'Amz预计售价$',
            'amz_retail_price_rmb' => 'Amz预计售价¥',
            'pur_complete_status' => '是否完成',
            'sample_submit1' => '提交部长',
            'sample_submit2' => '提交财务',
            'is_quality' => '样品质量是否合格',
            'new_member' => '流转新的评审人',
            'submit1_at' => '采购提交时间',
            'submit2_at' => '提交财务时间',
            'is_agreest' => '是否同意付费',
            'create_date' => '经理评审时间',
            'is_purchase' => '确定采购?',
            'sample_return' => '确定退回样品?',
            'trading_company' => '供应商是否是贸易公司',
            'has_arrival' => '是否到货?',
            'minister_result' => '部长判断',
            'write_date' => '到货日期',
            'pd_sku' => 'SKU',
            'purchaser_send_time' => '采购提交时间',
            'is_patent_right' => '工厂对此产品是否有专利权或商标权',
            'is_third_party_abroad_right' => '国外第三方对此产品是否有专利权或商标权',
            'promise_rights' => '供应商承诺没有知识产权方面问题',
            'special_auth_FDA' => '是否需要特殊认证FDA或者电器CE Rosh',
            'sure_purchase_time' => '确定采购日期'
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     * 一个产品有多个评论
     */
    public function getPreview()
    {
        //第一个参数为要关联的子表模型类名，
        //第二个参数指定 通过子表的product_id，关联主表的pur_info_id字段
        return $this->hasMany(Preview::className(), ['product_id' => 'pur_info_id']);
    }

  public function getHeadman()
    {
        //第一个参数为要关联的子表模型类名，
        //第二个参数指定 通过子表的product_id，关联主表的pur_info_id字段
        return $this->hasMany(Headman::className(), ['product_id' => 'pur_info_id']);
    }


    /**
      * 一个产品有一个采购跟单申请
      *
      */

    public function getSample()
    {
        //第一个参数为要关联的子表模型类名，
        //第二个参数指定 通过子表的 spur_info_id，关联主表的pur_info_id字段
        return $this->hasOne(Sample::className(), ['spur_info_id' => 'pur_info_id']);
    }

    public function getPurchaser()
    {
        //第一个参数为要关联的子表模型类名，
        //第二个参数指定 通过子表的 purchaser，关联主表的purchaser字段
        return
            $this->hasOne(Purchaser::className(), ['`purchaser`.`purchaser`' => '`pur_info`.`purchaser`'])
            ;
    }





}
