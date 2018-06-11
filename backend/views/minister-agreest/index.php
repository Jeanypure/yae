<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MinisterAgreestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pur Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pur Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pur_info_id',
            'purchaser',
            'pur_group',
            'pd_title',
            'pd_title_en',
            //'pd_pic_url:url',
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
            //'hs_code',
            //'bill_tax_rebate',
            //'bill_rebate_amount',
            //'no_rebate_amount',
            //'retail_price',
            //'ebay_url:url',
            //'amazon_url:url',
            //'url_1688:url',
            //'else_url:url',
            //'shipping_fee',
            //'oversea_shipping_fee',
            //'transaction_fee',
            //'gross_profit',
            //'remark',
            //'parent_product_id',
            //'source',
            //'member',
            //'preview_status',
            //'brocast_status',
            //'master_member',
            //'master_mark',
            //'master_result',
            //'priview_time',
            //'ams_logistics_fee',
            //'is_submit',
            //'pd_create_time',
            //'is_submit_manager',
            //'pur_group_status',
            //'purchaser_leader',
            //'junior_submit',
            //'profit_rate',
            //'gross_profit_amz',
            //'profit_rate_amz',
            //'amz_fulfillment_cost',
            //'selling_on_amz_fee',
            //'amz_retail_price',
            //'amz_retail_price_rmb',
            //'is_assign',
            //'commit_date',
            //'audit_a',
            //'audit_b',
            //'bill_tax_value',
            //'pur_complete_status',
            //'pur_compelte_result',
            //'sample_submit2',
            //'sample_submit1',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
