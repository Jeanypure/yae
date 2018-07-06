<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id 公司ID
 * @property string $sub_company 子公司名字
 * @property string $department     部门
 * @property string $leader 部长
 * @property string $memo 备注
 * @property int $leader_id 部长ID 关联user
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['leader_id'], 'required'],
            [['leader_id'], 'integer'],
            [['sub_company', 'department', 'leader'], 'string', 'max' => 100],
            [['memo'], 'string', 'max' => 500],
            [['full_name'], 'string', 'max' => 200],
            [['has_site','no_site'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_company' => 'Sub Company',
            'department' => 'Department',
            'leader' => 'Leader',
            'memo' => 'Memo',
            'leader_id' => 'Leader ID',
            'has_site' => '已有站点',
            'no_site' => '尚无站点',
            'full_name' => '公司全称',
        ];
    }
}
