<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisition-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tran_internal_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tranid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_internal_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'povendor_internalid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'povendor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createdate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastmodifieddate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trandate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currencyname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supplier_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_qq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'arrival_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_method')->textInput() ?>

    <?= $form->field($model, 'negotiant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commit_time')->textInput() ?>

    <?= $form->field($model, 'commit_status')->textInput() ?>

    <?= $form->field($model, 'audit_time')->textInput() ?>

    <?= $form->field($model, 'audit_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
