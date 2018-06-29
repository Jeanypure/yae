<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fee_category".
 *
 * @property int $id ID
 * @property string $name_en 英文名
 * @property string $name_zn 中文名
 * @property string $remark
 */
class FeeCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fee_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'name_zn'], 'required'],
            [['name_en', 'name_zn'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_en' => 'Name En',
            'name_zn' => 'Name Zn',
            'remark' => 'Remark',
        ];
    }
}
