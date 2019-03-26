<?php

namespace backend\modules\cost\models;

use Yii;

/**
 * This is the model class for table "domestic_freight".
 *
 * @property int $dfid ID
 * @property string $purchase_no 合同号
 * @property string $sku 货号
 * @property string $freight 运费
 * @property string $creator 创建人
 * @property string $applicant 申请人
 * @property string $subsidiaries 子公司
 * @property string $group 组别
 * @property string $create_date 创建日期
 * @property string $application_date 申请日期
 */
class DomesticFreight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'domestic_freight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['freight'], 'number'],
            [['create_date', 'application_date'], 'safe'],
            [['purchase_no', 'group'], 'string', 'max' => 30],
            [['sku'], 'string', 'max' => 20],
            [['creator', 'applicant'], 'string', 'max' => 10],
            [['subsidiaries'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dfid' => 'Dfid',
            'purchase_no' => 'Purchase No',
            'sku' => 'Sku',
            'freight' => 'Freight',
            'creator' => 'Creator',
            'applicant' => 'Applicant',
            'subsidiaries' => 'Subsidiaries',
            'group' => 'Group',
            'create_date' => 'Create Date',
            'application_date' => 'Application Date',
        ];
    }
}
