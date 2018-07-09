<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplierSearch */
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

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
