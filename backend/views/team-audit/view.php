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

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <img src="<?php echo $model->pd_pic_url;?>" alt="" height="100" width="100">
    </p>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->pur_info_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->pur_info_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
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
            'bill_tax_value',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            'no_rebate_amount',
            'retail_price',
            'ebay_url:url',
            'amazon_url:url',
            'url_1688:url',
            'else_url:url',
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'gross_profit',
            'profit_rate',
            'gross_profit_amz',
            'profit_rate_amz',
            'selling_on_amz_fee',
            'amz_fulfillment_cost',
            'remark',
//            'parent_product_id',
            'source',
            'member',
            'preview_status',
            'brocast_status',
            'master_member',
            [
                'attribute'=>'master_result',
                'value'=>function($model){
                    if($model->master_result==0){
                        return "拒绝";
                    }elseif($model->master_result==1){
                        return "采样";
                    }elseif($model->master_result==2){
                        return "可以开发";
                    }
                }
            ],
            'master_mark',
            'priview_time',
            'ams_logistics_fee',
            'is_submit',
            'pd_create_time',
            'is_submit_manager',
            'pur_group_status',
            'purchaser_leader',

        ],
    ]) ?>

</div>
