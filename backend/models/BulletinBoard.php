<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bulletin_board}}".
 *
 * @property int $id ID
 * @property string $role_name 角色名称
 * @property string $note 主要事项
 */
class BulletinBoard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bulletin_board}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note'], 'string'],
            [['role_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_name' => '角色名称',
            'note' => '主要事项',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BulletinBoardQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BulletinBoardQuery(get_called_class());
    }
}
