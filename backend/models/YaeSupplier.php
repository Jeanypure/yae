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
 * @property int $pay_cycleTime_type 支付周期类型 1日结,2周结,3半月结,4月结,5隔月结 0 其他
 * @property int $account_type 供应商结算方式：1、货到付款。2、款到发货。3、周期结算。4、售后付款。5、默认方式（针对市场随意采购，无具体供应商信息的类型）
 * @property string $account_proportion 预付比例%
 * @property int $has_cooperate 是否为合作过的供应商 0 否 1是 
 * @property string $bill_img1 发票01
 * @property string $bill_img1_name_unit 发票01的开票品名和单位
 * @property string $bill_img2 发票02
 * @property string $bill_img2_name_unit 发票02的开票品名和单位
 * @property string $complete_num 资料提交齐全度%
 * @property int $licence_pass 营业执照审核通过 0 否 1 是 2未审核
 * @property int $bill_pass 开票资质审核通过 0 否 1 是 2未审核
 * @property int $bank_data_pass 银行信息审核通过0 否 1 是 2未审核
 * @property string $supplier_address 供应商地址
 * @property int $check_status 审核结果 0不通过 1通过 2半通过 3未处理
 */
class YaeSupplier extends \yii\db\ActiveRecord
{

    public  $bl_img_address;
    public  $bank_img_add;
    public  $bill01_img_add;
    public  $bill02_img_add;

    public $contact_name,$contact_tel,$contact_address,$contact_qq,$contact_wechat,$contact_wangwang,$skype,$contact_memo;
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
            [['sale_company','into_eccang_status','check_status','is_submit_vendor','bill_type', 'pay_cycleTime_type', 'account_type', 'has_cooperate', 'licence_pass', 'bill_pass', 'bank_data_pass'], 'integer'],
            [['supplier_code', 'bill_unit', 'submitter'], 'string', 'max' => 32],
            [['supplier_name', 'pd_bill_name'], 'string', 'max' => 64],
            [['business_licence', 'bank_account_data', 'bill_img1', 'bill_img2'], 'string', 'max' => 200],
            [['pay_card', 'pay_name', 'pay_bank', 'bill_img1_name_unit', 'bill_img2_name_unit'], 'string', 'max' => 128],
            [['sup_remark'], 'string', 'max' => 2000],
            [['account_proportion', 'complete_num', 'checker'], 'string', 'max' => 20],
            [['supplier_address'], 'string', 'max' => 216],
            [['check_memo'], 'string', 'max' => 300],
            [['supplier_code'], 'unique'],
            [['supplier_code','supplier_name','supplier_address','pay_cycleTime_type','account_type','account_proportion',
                'has_cooperate','submitter','pay_bank','pay_card','pay_name','pd_bill_name','bill_unit','bill_type',
                'business_licence','bank_account_data','check_status'
            ], 'required'],
            [['into_eccang_date','create_date','update_date','update_date','check_date' ], 'safe'],
            [['bill_img1_name_unit','bill_img2_name_unit'], function ($attribute, $param) {//至少要一个
                if (empty($this->bill_img1_name_unit) && empty($this->bill_img2_name_unit)) {
                    $this->addError($attribute, '发票01/发票02至少要填一个');
                }
            }, 'skipOnEmpty' => false],
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
            'supplier_address' => '供应商地址',
            'pd_bill_name' => '开票品名',
            'bill_unit' => '开票单位',
            'submitter' => '资料提交人',
            'bill_type' => '开票类型',
            'business_licence' => '营业执照',
            'bank_account_data' => '银行开户资料',
            'pay_card' => '收款卡号',
            'pay_name' => '收款人名称',
            'pay_bank' => '开户银行',
            'sup_remark' => '注意事项',
            'pay_cycleTime_type' => '支付周期类型',
            'account_type' => '结算方式',
            'account_proportion' => '预付比例%',
            'has_cooperate' => '是否合作过',
            'bill_img1' => '发票或纳税人资质照片',
            'bill_img1_name_unit' => '发票01的开票品名和单位',
            'bill_img2' => '其它资料照片',
            'bill_img2_name_unit' => '其它资料标题',
            'complete_num' => '资料提交齐全度%',
            'licence_pass' => '营业执照审核通过',
            'bill_pass' => '开票资质审核通过',
            'bank_data_pass' => '银行信息审核通过',
            'bl_img_address' => '营业执照图片地址',
            'bank_img_add' => '银行开户资料图片地址',
            'bill01_img_add' => '发票或纳税人资质照片地址',
            'bill02_img_add' => '其它资料照片图片地址',
            'is_submit_vendor' => '提交审核?',
            'check_status' => '审核状态',
            'check_memo' => '审核人备注',
            'checker' => '审核人',
            'into_eccang_status' => '是否导入易仓',
            'into_eccang_date' => '导入日期',
            'create_date' => '创建日期',
            'update_date' => '更新日期',
            'submit_date' => '提交日期',
            'check_date' => '审核日期',
            'sale_company' => '销售公司',
            'has_tons' => '已导NetSuite?',
        ];

    }


        /**
         * 一个供应商多个联系人
         */

        public  function  getSupplierContact(){
            return $this->hasOne(SupplierContact::className(),['supplier_id'=>'id']);
        }


}

