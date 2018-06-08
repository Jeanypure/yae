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
    <p>
<!--        --><?php //echo  Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->pur_info_id], ['class' => 'btn btn-primary']) ?>
        <?php
//        echo  Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->pur_info_id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]) ;
        ?>
    </p>

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
