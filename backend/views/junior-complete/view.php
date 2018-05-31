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
    <p>
        <img src="<?php echo $model->pd_pic_url ;?>" alt="" width="100" height="100">

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
            ['attribute'=>'ebay_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'amazon_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'url_1688','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'else_url','format'=>['url',['target'=>'_blank']]],
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'remark',
            'parent_product_id',
            'source',
        ],
    ]) ?>

</div>
