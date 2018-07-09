<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '部长审批'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-view">

    <p>
        <img src="<?php echo  $model->pd_pic_url ?>" alt="" height="100" width="100">
    </p>


    <?php
    if(!empty($sample_model)&&isset($sample_model)){
        echo  $this->render('sample_form', [
            'model' => $sample_model,
        ]);
    }

    ?>


    <h3> 2 样品费用信息 </h3>
    <?= DetailView::widget([
        'model' => $sample_model,
        'attributes' => [
            'procurement_cost',
            'sample_freight',
            'else_fee',
            'pay_amount',
            'pay_way',
            'mark',
            ['attribute'=>'fee_return',
                'value'=>function($model){
                    if($model->fee_return==1){
                        return "是";
                    }elseif($model->fee_return==0){
                        return "否";
                    }elseif($model->fee_return==2){
                        return "其他";
                    }
                }
            ],
            ['attribute'=>'for_free',
                'value'=>function($model){
                    if($model->for_free==1){
                        return "是";
                    }elseif($model->for_free==0){
                        return "否";
                    }elseif($model->for_free==2){
                        return "其他";
                    }
                }
            ],
            'create_date',
            'lastop_date',
        ],
    ]) ?>

   <h3> 3 产品详情 </h3>

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
            'is_huge',
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'old_costprice',
            'has_shipping_fee',
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
        ],
    ]) ?>

</div>
