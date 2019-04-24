<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "preview".
 *
 * @property int $preview_id 评审ID
 * @property string $member 评审人
 * @property string $product_id
 * @property string $content 评审建议
 * @property string $result 评审结果  0采样 1可开发  2拒绝（不合适不跟踪）
 * @property string $priview_time 评审时间
 * @property int $member_id 评审人ID
 * @property string $ref_url1 Amazon低价网址
 * @property string $ref_url2 eBay低价网址
 * @property string $ref_url3 1688低价网址
 * @property string $ref_url4 其他低价网址
 */
class Preview extends \yii\db\ActiveRecord
{
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
            [['result','content','ref_url1','ref_url3','bottom_price'], 'required'],
            [['priview_time','bottom_price'], 'safe'],
            [['member_id'], 'integer'],
            [['bottom_price'], 'number'],
            [['member2', 'content', 'result'], 'string', 'max' => 500],
            [['product_id'], 'string', 'max' => 20],
            [['ref_url1','ref_url12','ref_url13', 'ref_url2','ref_url22','ref_url23', 'ref_url3', 'ref_url4'], 'string', 'max' => 5000],
            [['product_id', 'member_id'], 'unique', 'targetAttribute' => ['product_id', 'member_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'preview_id' => 'Preview ID',
            'member2' => '评审人',
            'product_id' => 'Product ID',
            'content' => '评审内容',
            'result' => '评审结果',
            'priview_time' => '评审时间',
            'member_id' => 'Member ID',
            'ref_url1' => 'Amazon低价链接或其他链接',
            'ref_url12' => 'Amazon链接2',
            'ref_url13' => 'Amazon链接3',
            'ref_url2' => 'eBay低价链接',
            'ref_url22' => 'eBay链接2',
            'ref_url23' => 'eBay链接3',
            'ref_url3' => '1688低价链接或其他链接',
            'ref_url4' => '其他链接',
            'bottom_price' => '1688最低价格(RMB)--数字',
        ];
    }
}
