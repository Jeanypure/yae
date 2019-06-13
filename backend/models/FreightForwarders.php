<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%freight_forwarders}}".
 *
 * @property int $id ID
 * @property string $receiver 货代公司名
 * @property string $memo 备注
 */
class FreightForwarders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freight_forwarders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receiver', 'forwarders'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receiver' => 'Receiver',
            'forwarders' => 'Forwarders',
        ];
    }
}
