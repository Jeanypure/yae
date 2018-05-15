<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id 产品ID
 * @property string $product_title_en 产品英文名称
 * @property string $product_title 产品中文名
 * @property string $product_purchase_value 建议采购价
 * @property string $ref_url1 Amazon参考网址
 * @property string $ref_url2 eBay参考网址
 * @property string $ref_url3 1688参考网址
 * @property string $ref_url4 其他参考网址
 * @property string $product_add_time 产品添加时间
 * @property string $product_update_time 产品最后更新时间
 * @property string $purchaser 采购
 * @property string $creator 推荐人
 * @property string $product_status 产品状态
 * @property string $pd_pic_url 产品图片
 * @property string $preview_time 产品评审时间
 * @property string $preview_mark 通过原因
 * @property string $sub_company 分公司名称
 * @property int $sub_company_id 分公司ID
 * @property string $group_mark 分组原因
 * @property string $group_time 产品分组时间
 * @property string $group_update_time 分组更新时间
 * @property string $group_status 分组状态
 * @property string $brocast_status 分组状态
 * @property string $ref_url_low1 Amazon最低价网址
 * @property string $ref_url_low2 eBay最低价网址
 * @property string $ref_url_low3 1688最低价网址
 * @property string $ref_url_low4 其他最低价网址
 * @property string $complete_status 完成状态 0 未完成 1 已完成
 * @property int $creator_id 创建者ID
 */
class Complete extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_purchase_value'], 'number'],
            [['product_add_time', 'product_update_time', 'preview_time', 'group_time', 'group_update_time'], 'safe'],
            [['purchaser'], 'required'],
            [['sub_company_id', 'creator_id'], 'integer'],
            [['product_title_en', 'product_title', 'ref_url1', 'ref_url2', 'ref_url3', 'ref_url4', 'group_mark', 'ref_url_low1', 'ref_url_low2', 'ref_url_low3', 'ref_url_low4'], 'string', 'max' => 255],
            [['purchaser', 'creator', 'product_status'], 'string', 'max' => 32],
            [['pd_pic_url', 'preview_mark'], 'string', 'max' => 500],
            [['sub_company'], 'string', 'max' => 60],
            [['group_status', 'brocast_status'], 'string', 'max' => 20],
            [['complete_status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_title_en' => 'Product Title En',
            'product_title' => 'Product Title',
            'product_purchase_value' => 'Product Purchase Value',
            'ref_url1' => 'Ref Url1',
            'ref_url2' => 'Ref Url2',
            'ref_url3' => 'Ref Url3',
            'ref_url4' => 'Ref Url4',
            'product_add_time' => 'Product Add Time',
            'product_update_time' => 'Product Update Time',
            'purchaser' => 'Purchaser',
            'creator' => 'Creator',
            'product_status' => 'Product Status',
            'pd_pic_url' => 'Pd Pic Url',
            'preview_time' => 'Preview Time',
            'preview_mark' => 'Preview Mark',
            'sub_company' => 'Sub Company',
            'sub_company_id' => 'Sub Company ID',
            'group_mark' => 'Group Mark',
            'group_time' => 'Group Time',
            'group_update_time' => 'Group Update Time',
            'group_status' => 'Group Status',
            'brocast_status' => 'Brocast Status',
            'ref_url_low1' => 'Ref Url Low1',
            'ref_url_low2' => 'Ref Url Low2',
            'ref_url_low3' => 'Ref Url Low3',
            'ref_url_low4' => 'Ref Url Low4',
            'complete_status' => 'Complete Status',
            'creator_id' => 'Creator ID',
        ];
    }
}
