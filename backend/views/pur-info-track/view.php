<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '采样申请'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pur_info_id',
            'purchaser',
            'pur_group',
            'pd_title',
            'pd_title_en',
            ['attribute'=>'pd_pic_url','format'=>['url',['target'=>'_blank']]],
            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            'is_huge',
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
            'bill_type',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            'no_rebate_amount',
            'retail_price',
            ['attribute'=>'ebay_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'amazon_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'url_1688','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'else_url','format'=>['url',['target'=>'_blank']]],
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'profit_rate',
            'gross_profit_amz',
            'profit_rate_amz',
            'selling_on_amz_fee',
            'amz_fulfillment_cost',
            'remark',
            [
                'attribute'=>'master_result',
                'value'=>function($model){
                    if($model->master_result==0){
                        return "拒绝";
                    }elseif($model->master_result==1){
                        return "采样";
                    }elseif($model->master_result==2){
                        return "需议价或谈其他条件";
                    }elseif($model->master_result==3){
                        return "未评审";
                    }elseif($model->master_result==4){
                        return "直接下单";
                    }elseif($model->master_result==5){
                        return "季节产品推迟";
                    }
                }
            ],
            'master_mark',
        ],
    ]) ?>

</div>
