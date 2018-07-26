<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%new_contract}}".
 *
 * @property int $id ID
 * @property string $buy_company 采购公司
 * @property string $declare_no1
 * @property string $project_no 项号
 * @property string $factory 工厂
 * @property string $purchase_contract_no 采购合同号
 * @property string $product_name 品名
 * @property string $unit 单位
 * @property int $quantity 数量
 * @property string $amount 金额
 * @property string $declare_no 报关合同协议号
 * @property string $purchaser 采购
 * @property string $sku SKU
 */
class NewContract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%new_contract}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity'], 'integer'],
            [['amount'], 'number'],
            [['buy_company', 'factory', 'product_name'], 'string', 'max' => 200],
            [['declare_no1', 'purchase_contract_no', 'declare_no', 'sku'], 'string', 'max' => 60],
            [['project_no'], 'string', 'max' => 10],
            [['unit', 'purchaser'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'buy_company' => '采购公司',
            'declare_no1' => '报关合同协议号1',
            'project_no' => '项号',
            'factory' => '工厂',
            'purchase_contract_no' => '采购合同号',
            'product_name' => '品名',
            'unit' => '单位',
            'quantity' => '数量',
            'amount' => '金额',
            'declare_no' => '报关合同协议号',
            'purchaser' => '采购',
            'sku' => 'SKU',
        ];
    }
}
