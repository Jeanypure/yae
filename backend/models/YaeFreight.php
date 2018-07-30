<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%yae_freight}}".
 *
 * @property int $id ID
 * @property string $bill_to 付款方
 * @property string $receiver 收款方
 * @property string $shipment_id FBA单号
 * @property string $pod 目的港
 * @property string $pol 装货港
 * @property string $remark 备注
 * @property string $image 图片地址
 * @property int $to_minister 0 未提交 1 已提交
 * @property int $to_financial 0 未提交 1 已提交
 * @property int $mini_deal 0 未处理 1 已处理
 * @property int $fina_deal 0 未处理 1 已处理
 * @property string $mini_res 部长处理结果
 * @property string $fina_res 财务处理结果
 * @property string $builder 建单人
 * @property string $build_at 建单时间
 * @property string $update_at 更新时间
 * @property string $payer 付款人
 * @property string $pay_at 付款时间
 * @property string $etd ETD
 * @property string $eta ETA
 * @property string $contract_no 合同号
 * @property string $debit_no 单号号
 *
 * @property FreightFee[] $freightFees
 */
class YaeFreight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%yae_freight}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['minister','bill_to', 'receiver', 'pod', 'pol'], 'required'],
            [['to_minister', 'to_financial', 'mini_deal', 'fina_deal'], 'integer'],
            [['build_at', 'update_at', 'pay_at', 'etd', 'eta'], 'safe'],
            [['bill_to', 'receiver', 'shipment_id', 'image', 'mini_res', 'fina_res'], 'string', 'max' => 200],
            [['pod', 'pol', 'builder'], 'string', 'max' => 60],
            [['remark'], 'string', 'max' => 500],
            [['payer'], 'string', 'max' => 30],
            [['contract_no', 'debit_no'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_to' => 'Bill To',
            'receiver' => 'Receiver',
            'shipment_id' => 'Shipment ID',
            'pod' => 'Pod',
            'pol' => 'Pol',
            'remark' => 'Remark',
            'image' => 'Image',
            'to_minister' => 'To Minister',
            'to_financial' => 'To Financial',
            'mini_deal' => 'Mini Deal',
            'fina_deal' => 'Fina Deal',
            'mini_res' => 'Mini Res',
            'fina_res' => 'Fina Res',
            'builder' => 'Builder',
            'build_at' => 'Build At',
            'update_at' => 'Update At',
            'payer' => 'Payer',
            'pay_at' => 'Pay At',
            'etd' => 'Etd',
            'eta' => 'Eta',
            'contract_no' => 'Contract No',
            'debit_no' => 'Debit No',
            'minister' => 'Minister',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFreightFees()
    {
        return $this->hasMany(FreightFee::className(), ['freight_id' => 'id']);
    }
}
