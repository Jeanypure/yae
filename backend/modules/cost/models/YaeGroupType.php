<?php

namespace backend\modules\cost\models;

use Yii;

/**
 * This is the model class for table "yae_group_type".
 *
 * @property int $id ID
 * @property string $item_name 名称
 * @property int $parent_id 父ID
 */
class YaeGroupType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yae_group_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['item_name'], 'string', 'max' => 30],
            [['item_name', 'parent_id'], 'unique', 'targetAttribute' => ['item_name', 'parent_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => 'Item Name',
            'parent_id' => 'Parent ID',
        ];
    }

}
