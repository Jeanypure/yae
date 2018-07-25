<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "freight_fee".
 *
 * @property int $id ID
 * @property int $freight_id 外键
 * @property int $description_id fee_category的ID
 * @property int $quantity 数量
 * @property string $unit_price 单价
 * @property string $currency 币种
 * @property string $amount 金额
 * @property string $remark 备注
 *
 * @property YaeFreight $freight
 */
class FreightFee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'freight_fee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['freight_id', 'description_id'], 'integer'],
            [['description_id'], 'required'],
            [['unit_price', 'amount', 'quantity'], 'number'],
            [['currency'], 'string', 'max' => 10],
            [['remark'], 'string', 'max' => 100],
            [['freight_id'], 'exist', 'skipOnError' => true, 'targetClass' => YaeFreight::className(), 'targetAttribute' => ['freight_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'freight_id' => 'Freight ID',
            'description_id' => 'Description',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
            'currency' => 'Currency',
            'amount' => 'Amount',
            'remark' => 'Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFreight()
    {
        return $this->hasOne(YaeFreight::className(), ['id' => 'freight_id']);
    }
}
