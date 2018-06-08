<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-view">
    <img src="<?php echo $model->pd_pic_url?>" alt="" style="height: 100px;width: 100px">




    <?php if(!empty($sample_model)&&isset($sample_model)){ ?>
        <div class="pur-info-form">

            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', '同意'), ['class' => 'btn btn-success']) ?>
                <?= Html::submitButton(Yii::t('app', '不同意'), ['class' => 'btn btn-danger']) ?>

            </div>


            <?php ActiveForm::end(); ?>

        </div>
        <h3> 1 样品费用信息  </h3>
                   <?= DetailView::widget([
        'model' => $sample_model,
        'attributes' => [
//            'sample_id',
//            'spur_info_id',
            'procurement_cost',
            'sample_freight',
            'else_fee',
            'pay_amount',
            'pay_way',
            'mark',
            'is_audit',
            'is_agreest',
            'is_quality',
            'fee_return',
//            'audit_mem1',
//            'audit_mem2',
//            'audit_mem3',
            'applicant',
            'create_date',
            'lastop_date',
        ],

     ]) ?>
            <?php }?>

    <h3>2 产品信息 </h3>
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
            'member',
            'preview_status',
            'brocast_status',
        ],
    ]) ?>

</div>
