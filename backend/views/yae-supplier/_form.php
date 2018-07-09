<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supplier_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supplier_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_bill_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'submitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_type')->textInput() ?>

    <?= $form->field($model, 'business_licence')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_account_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
