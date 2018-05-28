<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\BrocastPurSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '自主开发-公示列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">


    <p>
<!--        --><?php //echo  Html::a(Yii::t('app', 'Create Pur Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export'=>false,
        'options' =>['style'=>'overflow:auto; white-space:nowrap;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                }
            ],
//            'pur_info_id',
            'purchaser',
            'pur_group',
            [
                'attribute'=>'pd_title',
                'value' => function($model) { return $model->pd_title;},
                'contentOptions'=> ['style' => 'width: 50%; overflow: scroll;word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'pd_title_en',
                'value' => function($model) { return $model->pd_title_en;},
                'contentOptions'=> ['style' => 'width: 50%; overflow: scroll;word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
//            [
//                'attribute'=>'pd_package',
//                'value' => function($model) { return $model->pd_package;},
//                'contentOptions'=> ['style' => 'width: 50%; overflow: scroll;word-wrap: break-word;white-space:pre-line;'],
//                'format'=>'html',
//                'headerOptions' => [
//                    'width'=>'80%'
//                ],
//            ],
            'pd_length',
            'pd_width',
            'pd_height',
            'is_huge',
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
//            [
//                'attribute'=>'pd_material',
//                'value' => function($model) { return $model->pd_material;},
//                'contentOptions'=> ['style' => 'width: 50%; overflow: scroll;word-wrap: break-word;white-space:pre-line;'],
//                'format'=>'html',
//                'headerOptions' => [
//                    'width'=>'80%'
//                ],
//            ],

            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
            'bill_type',
            'bill_tax_value',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            'no_rebate_amount',
            'retail_price',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->amazon_url)) return "<a href='$model->amazon_url' target='_blank'>".parse_url($model->amazon_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ebay_url)) return "<a href='$model->ebay_url' target='_blank'>".parse_url($model->ebay_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->url_1688)) return "<a href='$model->url_1688' target='_blank'>".parse_url($model->url_1688)['host']."</a>";
                }
            ],

            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
//            'remark',
//            'parent_product_id',

        ],
    ]); ?>

</div>
