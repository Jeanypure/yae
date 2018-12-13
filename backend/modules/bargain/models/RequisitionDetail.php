<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%requisition_detail}}".
 *
 * @property int $id ID
 * @property string $tran_internal_id 请购单ID
 * @property string $tranid 请购单号
 * @property string $amount 金额
 * @property string $description 产品名称
 * @property string $item_internal_id SKU内部ID
 * @property string $item_name SKU
 * @property string $povendor_internalid 供应商ID
 * @property string $povendor_name 供应商代码
 * @property int $quantity 数量
 * @property string $rate 单价
 * @property string $createdate
 * @property string $lastmodifieddate 最近修改日期
 * @property string $trandate 交易日期
 * @property string $currencyname 币种
 * @property string $supplier_name 供应商名称
 * @property string $contact_name 联系姓名
 * @property string $contact_tel 联系电话
 * @property string $contact_qq QQ
 * @property string $bill_type 开票类型
 * @property string $arrival_date 到货日期
 * @property int $payment_method 票款顺序 付款方式 1 票到付款  2 先预付再开票再付尾款  3 先付款后开票
 * @property string $negotiant 议价人
 * @property string $commit_time 议价人提交时间
 * @property int $commit_status 提交状态 0 未提交 1 已提交
 * @property string $audit_time 审核时间
 * @property int $audit_status 审核状态 0 未审核 1 已审核同步
 */
class RequisitionDetail extends \yii\db\ActiveRecord
{
    public $bargain;
    public $name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%requisition_detail}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'rate','last_price_min','after_bargain_price'], 'number'],
            [['quantity', 'payment_method', 'commit_status', 'audit_status'], 'integer'],
            [['commit_time', 'audit_time'], 'safe'],
            [['tran_internal_id', 'item_internal_id', 'povendor_internalid', 'povendor_name'], 'string', 'max' => 11],
            [['tranid', 'item_name', 'createdate', 'lastmodifieddate', 'trandate'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 200],
            [['currencyname', 'arrival_date'], 'string', 'max' => 10],
            [['supplier_name'], 'string', 'max' => 64],
            [['contact_name', 'contact_tel'], 'string', 'max' => 32],
            [['contact_qq', 'negotiant'], 'string', 'max' => 16],
            [['bill_type'], 'string', 'max' => 30],
        ];
    }





    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tran_internal_id' => 'Tran Internal ID',
            'tranid' => '请购单号',
            'amount' => 'Amount',
            'description' => '产品中文名',
            'item_internal_id' => 'Item Internal ID',
            'item_name' => 'SKU',
            'povendor_internalid' => 'Povendor Internalid',
            'povendor_name' => '供应商代码',
            'quantity' => '数量',
            'rate' => 'Rate',
            'createdate' => '请购日期',
            'lastmodifieddate' => 'Lastmodifieddate',
            'trandate' => 'Trandate',
            'currencyname' => 'Currencyname',
            'negotiant' => '议价人',
            'commit_time' => 'Commit Time',
            'commit_status' => 'Commit Status',
            'audit_time' => 'Audit Time',
            'audit_status' => 'Audit Status',
            'last_price_min' => '近期底价',
            'after_bargain_price' => '议价后价格(含税)',
            'name' => '请购人2',
            'bargain' => '议价人',
            'commit_status' => '是否提交'

        ];
    }


    public function getTb_requisition_non_purchase(){
        return $this->hasOne(RequisitionNonPurchase::className(),['tranid' => 'tranid','sku' => 'item_name']);
    }

    public function  getTb_lotnumbered_inventory_item(){
        return $this->hasMany(LotnumberedInventoryItem::className(),['sku' =>'item_name']);
    }
}
