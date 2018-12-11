<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%tb_lotnumbered_inventory_item}}".
 *
 * @property int $id ID
 * @property string $internalid 内部ID
 * @property string $sku SKU
 * @property string $property 产品所属开发人员
 * @property string $bargain 议价人
 */
class LotnumberedInventoryItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_lotnumbered_inventory_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['internalid'], 'string', 'max' => 11],
            [['sku', 'property'], 'string', 'max' => 30],
            [['bargain'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'internalid' => 'Internalid',
            'sku' => 'Sku',
            'property' => 'Property',
            'bargain' => 'Bargain',
        ];
    }
}
