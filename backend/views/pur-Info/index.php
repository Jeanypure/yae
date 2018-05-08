<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '采购列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建新品'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
            ],
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
            'pur_responsible_id',

            'pur_group',
            'pd_title',
            'pd_title_en',
            //'pd_package',
            //'pd_length',
            //'pd_width',
            //'pd_height',
            //'is_huge',
            //'pd_weight',
            //'pd_throw_weight',
            //'pd_count_weight',
            //'pd_material',
            //'pd_purchase_num',
            //'pd_pur_costprice',
            //'has_shipping_fee',
            //'bill_type',
            //'bill_tax_value',
            //'hs_code',
            //'bill_tax_rebate',
            //'bill_rebate_amount',
            //'no_rebate_amount',
            //'retail_price',
            //'ebay_url:url',
            //'amazon_url:url',
            //'url_1688:url',
            //'shipping_fee',
            //'oversea_shipping_fee',
            //'transaction_fee',
            //'gross_profit',
            //'remark',
            //'parent_product_id',

        ],
    ]); ?>
</div>
