<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchaser".
 *
 * @property int $id 主键
 * @property string $purchaser 采购
 * @property int $role 工作角色列表 0采购 1支持部门 2其他
 * @property string $memo 备注
 * @property string $code 身份编号
 */
class Purchaser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchaser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchaser'], 'required'],
            [['has_used','role'], 'integer'],
            [['purchaser'], 'string', 'max' => 20],
            [['memo'], 'string', 'max' => 500],
            [['code'], 'string', 'max' => 30],
            [['grade'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purchaser' => '英文名',
            'role' => '角色',
            'memo' => '备注',
            'code' => '采购组',
            'has_used' => '是否在用',
            'grade' => '提成级别',


        ];
    }
}
