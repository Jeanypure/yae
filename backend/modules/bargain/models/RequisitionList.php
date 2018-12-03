<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%requisition_list}}".
 *
 * @property int $id ID
 * @property string $internal_id ns内部ID
 * @property string $requisition_date 请购日期
 * @property string $document_number 请购单号
 * @property string $requisition_name 请购人
 * @property string $status 请购状态  0 Pending Order 1 Fully Ordered  2 Partially Ordered 
            3 Partially Received 4 Closed 5 Pending Approval
 * @property string $memo 备注
 * @property string $amount 请购数额
 * @property string $currency 币种
 * @property string $get_record_time 获取记录时间
 * @property string $push_record_time 同步记录时间
 * @property string $update_record_time 修改记录时间
 */
class RequisitionList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%requisition_list}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['get_record_time', 'push_record_time', 'update_record_time'], 'safe'],
            [['internal_id'], 'string', 'max' => 20],
            [['requisition_date', 'document_number', 'requisition_name'], 'string', 'max' => 11],
            [['status'], 'string', 'max' => 30],
            [['memo'], 'string', 'max' => 200],
            [['currency'], 'string', 'max' => 12],
            [['internal_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'internal_id' => 'Internal ID',
            'requisition_date' => 'Requisition Date',
            'document_number' => 'Document Number',
            'requisition_name' => '请购人',
            'status' => 'Status',
            'memo' => 'Memo',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'get_record_time' => 'Get Record Time',
            'push_record_time' => 'Push Record Time',
            'update_record_time' => 'Update Record Time',
        ];
    }


}
