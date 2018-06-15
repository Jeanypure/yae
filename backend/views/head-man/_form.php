<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pur-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pur_group')->textInput() ?>

    <?= $form->field($model, 'pd_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_pic_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_package')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_length')->textInput() ?>

    <?= $form->field($model, 'pd_width')->textInput() ?>

    <?= $form->field($model, 'pd_height')->textInput() ?>

    <?= $form->field($model, 'is_huge')->textInput() ?>

    <?= $form->field($model, 'pd_weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_throw_weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_count_weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_purchase_num')->textInput() ?>

    <?= $form->field($model, 'pd_pur_costprice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'has_shipping_fee')->textInput() ?>

    <?= $form->field($model, 'bill_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hs_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_tax_rebate')->textInput() ?>

    <?= $form->field($model, 'bill_rebate_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_rebate_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ebay_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amazon_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_1688')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'else_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oversea_shipping_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gross_profit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_product_id')->textInput() ?>

    <?= $form->field($model, 'source')->textInput() ?>

    <?= $form->field($model, 'member')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_status')->textInput() ?>

    <?= $form->field($model, 'brocast_status')->textInput() ?>

    <?= $form->field($model, 'master_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'master_result')->textInput() ?>

    <?= $form->field($model, 'ams_logistics_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_submit')->textInput() ?>

    <?= $form->field($model, 'pd_create_time')->textInput() ?>

    <?= $form->field($model, 'is_submit_manager')->textInput() ?>

    <?= $form->field($model, 'junior_submit')->textInput() ?>

    <?= $form->field($model, 'profit_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gross_profit_amz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profit_rate_amz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amz_fulfillment_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'selling_on_amz_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amz_retail_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amz_retail_price_rmb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_assign')->textInput() ?>

    <?= $form->field($model, 'pur_complete_status')->textInput() ?>

    <?= $form->field($model, 'sample_submit2')->textInput() ?>

    <?= $form->field($model, 'sample_submit1')->textInput() ?>

    <?= $form->field($model, 'is_quality')->textInput() ?>

    <?= $form->field($model, 'new_member')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fact_pay_amount')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
