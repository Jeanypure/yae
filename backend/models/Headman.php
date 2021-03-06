<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "headman".
 *
 * @property int $preview_id 评审ID
 * @property string $headman 评审人
 * @property string $site
 * @property string $product_id
 * @property string $content 评审建议
 * @property string $result 评审结果  0采样 1可开发  2拒绝（不合适不跟踪）
 * @property string $priview_time 评审时间
 * @property string $ref_url1 Amazon低价网址
 * @property string $ref_url2 eBay低价网址
 * @property string $ref_url3 1688低价网址
 * @property string $ref_url4 其他低价网址
 * @property int $view_status view状态  0 未评审 1 已评审
 * @property int $submit_manager 提交评审 0未提交 1已提交
 */
class Headman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'headman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['priview_time'], 'safe'],
            [['view_status', 'submit_manager'], 'integer'],
            [['headman'], 'string', 'max' => 30],
            [['site'], 'string', 'max' => 10],
            [['product_id'], 'string', 'max' => 20],
            [['content', 'result'], 'string', 'max' => 500],
            [['ref_url1', 'ref_url2', 'ref_url3', 'ref_url4','ref_url12', 'ref_url13','ref_url22', 'ref_url23',], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'preview_id' => 'Preview ID',
            'headman' => 'Headman',
            'site' => 'Site',
            'product_id' => 'Product ID',
            'content' => '评审内容',
            'result' => '评审结果',
            'priview_time' => 'Priview Time',
            'ref_url1' => 'Amazon参考网址',
            'ref_url12' => 'Amazon参考网址2',
            'ref_url13' => 'Amazon参考网址3',
            'ref_url2' => 'eBay参考网址',
            'ref_url22' => 'eBay参考网址2',
            'ref_url23' => 'eBay参考网址3',
            'ref_url3' => '1688参考网址',
            'ref_url4' => '其他网址',
            'view_status' => 'View Status',
            'submit_manager' => 'Submit Manager',
        ];
    }
}
