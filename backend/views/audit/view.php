<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-view">

    <img src="<?php echo $model->pd_pic_url ?>" alt="" width="100" height="100">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pur_info_id',
            'purchaser',
            'pur_group',
            'pd_title',
            'pd_title_en',
            'pd_pic_url:url',
            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            [
                'attribute'=>'is_huge',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->is_huge ==1 ){
                        return '是';
                    }else{
                        return '否';
                    }
                },
            ],

            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'old_costprice',
            [
                'attribute'=>'has_shipping_fee',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->has_shipping_fee ==1 ){
                        return '是';
                    }else{
                        return '否';
                    }
                },
            ],

            'bill_type',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            [
                'attribute'=>'ebay_url',
                'format'=>'raw',
                'value' => function ($model) {
                    if (!empty($model->ebay_url)) return "<a href='$model->ebay_url' target='_blank'>".parse_url($model->ebay_url)['host']."</a>";

                },
            ],
            [
                'attribute'=>'amazon_url',
                'format'=>'raw',
                'value' => function ($model) {
                    if (!empty($model->amazon_url)) return "<a href='$model->amazon_url' target='_blank'>".parse_url($model->amazon_url)['host']."</a>";

                },
            ],
            [
                'attribute'=>'url_1688',
                'format'=>'raw',
                'value' => function ($model) {
                    if (!empty($model->url_1688)) return "<a href='$model->url_1688' target='_blank'>".parse_url($model->url_1688)['host']."</a>";

                },
            ],

            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'retail_price',
            'no_rebate_amount',
            'gross_profit',
            'profit_rate',
            'amz_retail_price',
            'amz_retail_price_rmb',
            'gross_profit_amz',
            'profit_rate_amz',
            'remark',
            [
                'attribute'=>'trading_company',
                'format'=>'raw',
                'value' => function ($model) {
                        if($model->trading_company ==1 ){
                            return '是';
                        }else{
                            return '否';
                        }
                },
            ],
            [
                'attribute'=>'is_patent_right',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->is_patent_right ==1 ){
                        return '是';
                    }elseif($model->is_patent_right ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],
            [
                'attribute'=>'is_third_party_abroad_right',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->is_third_party_abroad_right ==1 ){
                        return '是';
                    }elseif($model->is_third_party_abroad_right ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],
            [
                'attribute'=>'promise_rights',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->promise_rights ==1 ){
                        return '是';
                    }elseif($model->promise_rights ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],
            [
                'attribute'=>'special_auth_FDA',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->special_auth_FDA ==1 ){
                        return '是';
                    }elseif($model->special_auth_FDA ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],

        ],
    ]) ?>

</div>
