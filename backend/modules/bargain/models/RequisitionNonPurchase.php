<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%tb_requisition_non_purchase}}".
 *
 * @property int $id ID
 * @property string $tran_internal_id 请购单ID
 * @property string $tranid 请购单号
 * @property string $name 请购人
 * @property string $amount 金额
 * @property string $description 产品名称
 * @property string $item_internal_id SKU内部ID
 * @property string $item_name SKU
 * @property int $quantity 数量
 * @property string $rate 单价
 * @property string $createdate 请购日期
 * @property string $lastmodifieddate 最近修改日期
 */
class RequisitionNonPurchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_requisition_non_purchase}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'rate'], 'number'],
            [['quantity'], 'integer'],
            [['createdate'], 'safe'],
            [['tran_internal_id', 'item_internal_id'], 'string', 'max' => 11],
            [['tranid', 'item_name', 'lastmodifieddate'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 200],
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
            'name' => 'Name',
            'amount' => 'Amount',
            'description' => 'Description',
            'item_internal_id' => 'Item Internal ID',
            'item_name' => 'Item Name',
            'quantity' => 'Quantity',
            'rate' => 'Rate',
            'createdate' => 'Createdate',
            'lastmodifieddate' => 'Lastmodifieddate',
        ];
    }
}
