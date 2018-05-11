<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id 公司ID
 * @property string $sub_company 子公司名字
 * @property string $department 部门
 * @property string $leader 部长
 * @property string $memo 备注
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_company', 'department', 'leader'], 'string', 'max' => 100],
            [['memo'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_company' => 'Sub Company',
            'department' => 'Department',
            'leader' => 'Leader',
            'memo' => 'Memo',
        ];
    }
}
