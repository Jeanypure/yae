<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id 自增ID
 * @property string $goodsname_cn 商品中文名
 * @property string $goodsname_en 商品英文名
 * @property double $retail 建议采购价格
 * @property string $link1 Amazon链接
 * @property string $link2 eBay链接
 * @property string $link3 1688链接
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsname_cn', 'goodsname_en', 'retail', 'link1', 'link2', 'link3', 'created_at', 'updated_at'], 'required'],
            [['retail'], 'number'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['goodsname_cn', 'goodsname_en'], 'string', 'max' => 200],
            [['link1', 'link2', 'link3'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsname_cn' => 'Goodsname Cn',
            'goodsname_en' => 'Goodsname En',
            'retail' => 'Retail',
            'link1' => 'Link1',
            'link2' => 'Link2',
            'link3' => 'Link3',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
