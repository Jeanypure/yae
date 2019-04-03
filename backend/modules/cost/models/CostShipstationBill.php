<?php

namespace backend\modules\cost\models;

use Yii;

/**
 * This is the model class for table "{{%cost_shipstation_bill}}".
 *
 * @property int $id ID
 * @property string $date Date
 * @property string $invoice Invoice#
 * @property string $subtotal Subtotal
 * @property string $exchange_rate 汇率
 * @property string $amount RMB金额
 * @property string $department 公司
 */
class CostShipstationBill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cost_shipstation_bill}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['subtotal', 'exchange_rate', 'amount'], 'number'],
            [['invoice', 'department'], 'string', 'max' => 20],
            [['invoice'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'invoice' => 'Invoice#',
            'subtotal' => 'Subtotal',
            'exchange_rate' => '汇率',
            'amount' => 'RMB金额',
            'department' => '公司',
        ];
    }
}
