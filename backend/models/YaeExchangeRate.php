<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "yae_exchange_rate".
 *
 * @property int $id ID
 * @property string $exchange_rate 汇率
 * @property string $memo 备注
 * @property string $currency
 */
class YaeExchangeRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yae_exchange_rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exchange_rate'], 'number'],
            [['memo'], 'string', 'max' => 100],
            [['currency'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exchange_rate' => 'Exchange Rate',
            'memo' => 'Memo',
            'currency' => 'Currency',
        ];
    }
}
