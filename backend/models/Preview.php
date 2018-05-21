<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "preview".
 *
 * @property int $preview_id 评审ID
 * @property string $member 评审人
 * @property int $product_id 产品ID
 * @property string $content 评审建议
 * @property string $result 评审结果  0采样 1可开发  2拒绝（不合适不跟踪）
 * @property string $priview_time 评审时间
 * @property int $member_id 评审人ID
 */
class Preview extends \yii\db\ActiveRecord
{
//    public  $product_id;
    public  $pd_pic_url;
    public  $pd_title;
    public  $pd_title_en;
    public  $Jenny;
    public  $admin;
    public  $Max;
    public  $Heidi;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'member_id'], 'integer'],
            [['priview_time'], 'safe'],
            [['member', 'content', 'result'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'preview_id' => 'Preview ID',
            'member' => '评审人',
            'product_id' => 'Product ID',
            'content' => '备注',
            'result' => '结果',
            'priview_time' => '评审时间',
            'member_id' => 'Member ID',
            'pd_title' => '中文名',
            'pd_title_en' => '英文全称',
            'purchaser' => '采购人',
            'Jenny' => 'Jenny',
            'pur_group' => '部门',
        ];
    }
}
