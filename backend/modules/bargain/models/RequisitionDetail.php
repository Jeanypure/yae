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
 * @property string $linkedorder_internalid 采购单内部ID
 * @property string $linkedorder_name 采购单号
 * @property string $linkedorderstatus 采购单状态
 * @property string $povendor_internalid 供应商ID
 * @property string $povendor_name 供应商代码
 * @property int $quantity 数量
 * @property string $rate 单价
 * @property string $createdate
 * @property string $lastmodifieddate 最近修改日期
 * @property string $trandate 交易日期
 * @property string $currencyname 币种
 */
class RequisitionDetail extends \yii\db\ActiveRecord
{
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
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'rate'], 'number'],
            [['quantity'], 'integer'],
            [['tran_internal_id', 'item_internal_id', 'povendor_internalid', 'povendor_name'], 'string', 'max' => 11],
            [['tranid', 'item_name', 'createdate', 'lastmodifieddate', 'trandate'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 200],
            [['linkedorder_internalid', 'linkedorder_name'], 'string', 'max' => 8],
            [['linkedorderstatus'], 'string', 'max' => 30],
            [['currencyname'], 'string', 'max' => 10],
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
            'tranid' => 'Tranid',
            'amount' => 'Amount',
            'description' => '中文名',
            'item_internal_id' => 'Item Internal ID',
            'item_name' => 'SKU',
            'linkedorder_internalid' => 'Linkedorder Internalid',
            'linkedorder_name' => 'Linkedorder Name',
            'linkedorderstatus' => 'Linkedorderstatus',
            'povendor_internalid' => 'Povendor Internalid',
            'povendor_name' => '供应商代码',
            'quantity' => '采购数量',
            'rate' => 'Rate',
            'createdate' => '请购日期',
            'lastmodifieddate' => 'Lastmodifieddate',
            'trandate' => 'Trandate',
            'currencyname' => 'Currencyname',
        ];
    }
}
