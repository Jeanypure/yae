<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "yae_freight".
 *
 * @property int $id ID
 * @property string $bill_to 付款方
 * @property string $receiver 收款方
 * @property string $shipment_id 货单号
 * @property string $pod 目的港
 * @property string $pol 装货港
 * @property string $etd 预计离泊时间
 * @property string $eta 预计到达时间
 * @property string $remark 备注
 */
class YaeFreight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yae_freight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bill_to', 'receiver', 'shipment_id', 'pod', 'pol'], 'required'],
            [['to_minister','to_financial','mini_deal','fina_deal','mini_res','fina_res',
                'etd', 'eta', 'image'], 'safe'],
            [['mini_res','fina_res','bill_to', 'receiver', 'image'], 'string', 'max' => 200],
            [['shipment_id'], 'string', 'max' => 100],
            [['pod', 'pol'], 'string', 'max' => 60],
            [['remark'], 'string', 'max' => 500],
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
            'pod' => 'P.O.D',
            'pol' => 'P.O.L',
            'etd' => 'ETD',
            'eta' => 'ETA',
            'remark' => 'Remark',
            'image' => 'Image',
            'to_minister' => 'to_minister',
            'to_financial' => 'to_financial',
            'mini_deal' => 'mini_deal',
            'fina_deal' => 'fina_deal',
            'mini_res' => 'mini_res',
            'fina_res' => 'fina_res',
        ];
    }
}
