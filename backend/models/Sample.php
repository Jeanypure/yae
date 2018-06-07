<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sample".
 *
 * @property int $sample_id 主键 样品ID
 * @property int $spur_info_id 商品ID
 * @property string $procurement_cost 采购成本
 * @property string $sample_freight 运费
 * @property string $else_fee 其他费用
 * @property string $pay_amount 付款金额
 * @property string $pay_way 付款渠道
 * @property string $mark 备注
 * @property int $is_audit 审批状态 0审批中 1已审批 2退审 3已关闭
 * @property int $is_agreest 主管是否同意样品费 0否 1是
 * @property int $is_quality 样品是否合格 0否 1是
 * @property int $fee_return 是否退还样品费 0否 1是
 * @property int $audit_mem1 审批人1 部长
 * @property int $audit_mem2 审批人2 经理
 * @property int $audit_mem3 审批人3 财务
 * @property int $applicant 申请人
 * @property string $create_date 创建时间
 * @property string $lastop_date 最后处理时间
 */
class Sample extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['spur_info_id'], 'required'],
            [['spur_info_id', 'is_audit', 'is_agreest', 'is_quality', 'fee_return', 'audit_mem1', 'audit_mem2', 'audit_mem3', 'applicant'], 'integer'],
            [['procurement_cost', 'sample_freight', 'else_fee', 'pay_amount'], 'number'],
            [['create_date', 'lastop_date'], 'safe'],
            [['pay_way', 'mark'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sample_id' => 'Sample ID',
            'spur_info_id' => 'Spur Info ID',
            'procurement_cost' => 'Procurement Cost',
            'sample_freight' => 'Sample Freight',
            'else_fee' => 'Else Fee',
            'pay_amount' => 'Pay Amount',
            'pay_way' => 'Pay Way',
            'mark' => 'Mark',
            'is_audit' => 'Is Audit',
            'is_agreest' => 'Is Agreest',
            'is_quality' => 'Is Quality',
            'fee_return' => 'Fee Return',
            'audit_mem1' => 'Audit Mem1',
            'audit_mem2' => 'Audit Mem2',
            'audit_mem3' => 'Audit Mem3',
            'applicant' => 'Applicant',
            'create_date' => 'Create Date',
            'lastop_date' => 'Lastop Date',
        ];
    }
}
