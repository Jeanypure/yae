<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "yae_food_lists".
 *
 * @property int $id food_ID
 * @property string $food_name 菜名
 * @property string $memo 备注
 */
class YaeFoodLists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yae_food_lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_name', 'memo'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_name' => 'food_name',
            'memo' => 'memo',
        ];
    }
}
