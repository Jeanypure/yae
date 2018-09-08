<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FollowCheckSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pur-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pur_info_id') ?>

    <?= $form->field($model, 'purchaser') ?>

    <?= $form->field($model, 'pur_group') ?>

    <?= $form->field($model, 'pd_title') ?>

    <?= $form->field($model, 'pd_title_en') ?>

    <?php // echo $form->field($model, 'pd_pic_url') ?>

    <?php // echo $form->field($model, 'pd_package') ?>

    <?php // echo $form->field($model, 'pd_length') ?>

    <?php // echo $form->field($model, 'pd_width') ?>

    <?php // echo $form->field($model, 'pd_height') ?>

    <?php // echo $form->field($model, 'is_huge') ?>

    <?php // echo $form->field($model, 'pd_weight') ?>

    <?php // echo $form->field($model, 'pd_throw_weight') ?>

    <?php // echo $form->field($model, 'pd_count_weight') ?>

    <?php // echo $form->field($model, 'pd_material') ?>

    <?php // echo $form->field($model, 'pd_purchase_num') ?>

    <?php // echo $form->field($model, 'pd_pur_costprice') ?>

    <?php // echo $form->field($model, 'has_shipping_fee') ?>

    <?php // echo $form->field($model, 'bill_type') ?>

    <?php // echo $form->field($model, 'hs_code') ?>

    <?php // echo $form->field($model, 'bill_tax_rebate') ?>

    <?php // echo $form->field($model, 'bill_rebate_amount') ?>

    <?php // echo $form->field($model, 'no_rebate_amount') ?>

    <?php // echo $form->field($model, 'retail_price') ?>

    <?php // echo $form->field($model, 'ebay_url') ?>

    <?php // echo $form->field($model, 'amazon_url') ?>

    <?php // echo $form->field($model, 'url_1688') ?>

    <?php // echo $form->field($model, 'else_url') ?>

    <?php // echo $form->field($model, 'shipping_fee') ?>

    <?php // echo $form->field($model, 'oversea_shipping_fee') ?>

    <?php // echo $form->field($model, 'transaction_fee') ?>

    <?php // echo $form->field($model, 'gross_profit') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'parent_product_id') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'member') ?>

    <?php // echo $form->field($model, 'preview_status') ?>

    <?php // echo $form->field($model, 'brocast_status') ?>

    <?php // echo $form->field($model, 'master_member') ?>

    <?php // echo $form->field($model, 'master_mark') ?>

    <?php // echo $form->field($model, 'master_result') ?>

    <?php // echo $form->field($model, 'priview_time') ?>

    <?php // echo $form->field($model, 'ams_logistics_fee') ?>

    <?php // echo $form->field($model, 'is_submit') ?>

    <?php // echo $form->field($model, 'pd_create_time') ?>

    <?php // echo $form->field($model, 'is_submit_manager') ?>

    <?php // echo $form->field($model, 'pur_group_status') ?>

    <?php // echo $form->field($model, 'purchaser_leader') ?>

    <?php // echo $form->field($model, 'junior_submit') ?>

    <?php // echo $form->field($model, 'profit_rate') ?>

    <?php // echo $form->field($model, 'gross_profit_amz') ?>

    <?php // echo $form->field($model, 'profit_rate_amz') ?>

    <?php // echo $form->field($model, 'amz_fulfillment_cost') ?>

    <?php // echo $form->field($model, 'selling_on_amz_fee') ?>

    <?php // echo $form->field($model, 'amz_retail_price') ?>

    <?php // echo $form->field($model, 'amz_retail_price_rmb') ?>

    <?php // echo $form->field($model, 'is_assign') ?>

    <?php // echo $form->field($model, 'commit_date') ?>

    <?php // echo $form->field($model, 'audit_a') ?>

    <?php // echo $form->field($model, 'audit_b') ?>

    <?php // echo $form->field($model, 'bill_tax_value') ?>

    <?php // echo $form->field($model, 'pur_complete_status') ?>

    <?php // echo $form->field($model, 'pur_compelte_result') ?>

    <?php // echo $form->field($model, 'sample_submit2') ?>

    <?php // echo $form->field($model, 'sample_submit1') ?>

    <?php // echo $form->field($model, 'has_pay') ?>

    <?php // echo $form->field($model, 'is_quality') ?>

    <?php // echo $form->field($model, 'new_member') ?>

    <?php // echo $form->field($model, 'cancel1_at') ?>

    <?php // echo $form->field($model, 'cancel2_at') ?>

    <?php // echo $form->field($model, 'submit1_at') ?>

    <?php // echo $form->field($model, 'submit2_at') ?>

    <?php // echo $form->field($model, 'pay_at') ?>

    <?php // echo $form->field($model, 'fact_pay_amount') ?>

    <?php // echo $form->field($model, 'is_purchase') ?>

    <?php // echo $form->field($model, 'has_shared') ?>

    <?php // echo $form->field($model, 'payer') ?>

    <?php // echo $form->field($model, 'old_costprice') ?>

    <?php // echo $form->field($model, 'sample_return') ?>

    <?php // echo $form->field($model, 'trading_company') ?>

    <?php // echo $form->field($model, 'purchaser_send_time') ?>

    <?php // echo $form->field($model, 'junior_submit_at') ?>

    <?php // echo $form->field($model, 'old_purchaser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
