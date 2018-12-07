<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%tb_negotiant}}".
 *
 * @property int $id ID
 * @property string $sku_code1 SKU代码
 * @property string $purchaser 默认采购员
 * @property string $negotiant 默认议价人
 */
class Negotiant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_negotiant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku_code1'], 'string', 'max' => 4],
            [['purchaser', 'negotiant'], 'string', 'max' => 10],
            [['sku_code1', 'purchaser'], 'unique', 'targetAttribute' => ['sku_code1', 'purchaser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku_code1' => 'Sku Code1',
            'purchaser' => 'Purchaser',
            'negotiant' => 'Negotiant',
        ];
    }
}
