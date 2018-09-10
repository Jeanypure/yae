<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FollowCheckVendorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-supplier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'supplier_code') ?>

    <?= $form->field($model, 'supplier_name') ?>

    <?= $form->field($model, 'pd_bill_name') ?>

    <?= $form->field($model, 'bill_unit') ?>

    <?php // echo $form->field($model, 'submitter') ?>

    <?php // echo $form->field($model, 'bill_type') ?>

    <?php // echo $form->field($model, 'business_licence') ?>

    <?php // echo $form->field($model, 'bank_account_data') ?>

    <?php // echo $form->field($model, 'pay_card') ?>

    <?php // echo $form->field($model, 'pay_name') ?>

    <?php // echo $form->field($model, 'pay_bank') ?>

    <?php // echo $form->field($model, 'sup_remark') ?>

    <?php // echo $form->field($model, 'pay_cycleTime_type') ?>

    <?php // echo $form->field($model, 'account_type') ?>

    <?php // echo $form->field($model, 'account_proportion') ?>

    <?php // echo $form->field($model, 'has_cooperate') ?>

    <?php // echo $form->field($model, 'bill_img1') ?>

    <?php // echo $form->field($model, 'bill_img1_name_unit') ?>

    <?php // echo $form->field($model, 'bill_img2') ?>

    <?php // echo $form->field($model, 'bill_img2_name_unit') ?>

    <?php // echo $form->field($model, 'complete_num') ?>

    <?php // echo $form->field($model, 'licence_pass') ?>

    <?php // echo $form->field($model, 'bill_pass') ?>

    <?php // echo $form->field($model, 'bank_data_pass') ?>

    <?php // echo $form->field($model, 'supplier_address') ?>

    <?php // echo $form->field($model, 'is_submit_vendor') ?>

    <?php // echo $form->field($model, 'check_status') ?>

    <?php // echo $form->field($model, 'check_memo') ?>

    <?php // echo $form->field($model, 'checker') ?>

    <?php // echo $form->field($model, 'into_eccang_status') ?>

    <?php // echo $form->field($model, 'into_eccang_date') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'submit_date') ?>

    <?php // echo $form->field($model, 'check_date') ?>

    <?php // echo $form->field($model, 'sale_company') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
