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
 * @property string $is_submit 是否提交 0 uncommitted  1 commit
 */
class Product extends \yii\db\ActiveRecord
{
    public $is_submit;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_purchase_value'], 'number'],
            [['sale_submit','accept_status','group_status','brocast_status','sub_company',], 'integer'],
            [['product_add_time', 'product_update_time'], 'safe'],
            [['product_title_en','product_title','pd_pic_url'], 'required'],
            [['group_mark','preview_mark','product_title_en', 'product_title'], 'string', 'max' => 255],
            [[ 'ref_url1', 'ref_url2', 'ref_url3', 'ref_url4','pd_pic_url',], 'string', 'max' => 5000],
            [['complete_status','purchaser_leader','purchaser'], 'string', 'max' => 32],
            ['ref_url2','url','defaultScheme' => 'http'],
            ['ref_url1','url','defaultScheme' => 'http'],
            ['ref_url3','url','defaultScheme' => 'http'],
            ['ref_url4','url','defaultScheme' => 'http'],
            ['pd_pic_url','url','defaultScheme' => 'http']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => '产品ID',
            'product_title_en' => '英文全称',
            'product_title' => '中文全称',
            'product_purchase_value' => '采购价',
            'ref_url1' => 'Amazon链接',
            'ref_url2' => 'eBay链接',
            'ref_url3' => '1688链接',
            'ref_url4' => '其他链接',
            'product_add_time' => '添加时间',
            'product_update_time' => '更新时间',
            'creator' => '推荐人',
            'pd_pic_url' => '图片地址',
            'product_status' => '状态',
            'preview_mark' => '评审记录',
            'group_mark' => '分部原因',
            'sub_company' => '部门',
            'brocast_status' => '公示状态',
            'complete_status' => '完成状态',
            'purchaser' => '采购',
            'purchaser_leader' => '采购主管',
            'group_status' => '分部状态',
            'accept_status' => '接受状态',
            'sale_submit' => '是否提交',
            'commit_at' => '提交时间',
            'is_submit' => '采购完成提交'

        ];
    }

    /**
     * @description推荐产品表和产品表关联 product pur_info
     *
     */
    public function getPurinfo(){
        return $this->hasOne(PurInfo::className(),['parent_product_id' => 'product_id']);
    }
}
