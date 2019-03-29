<?php

namespace backend\modules\cost\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['memo'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dfid' => 'Dfid',
            'purchase_no' => '合同号',
            'sku' => '货号',
            'freight' => '费用',
            'creator' => '创建者',
            'applicant' => '申请人',
            'subsidiaries' => '分公司',
            'group' => '组别',
            'create_date' => '创建日期',
            'application_date' => '申请日期',
            'memo' => '备注'
        ];
    }

    /**
     * @param $pid
     * @return array
     * @description 获取部门对应的组
     */
    public function getSonList($pid){
        $model = YaeGroupType::find()->where('parent_id=:pid',[':pid'=>$pid])->all();
        return ArrayHelper::map($model,'id','item_name');
    }
}
