<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sample */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'spur_info_id')->textInput() ?>

    <?= $form->field($model, 'procurement_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sample_freight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'else_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_way')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_audit')->textInput() ?>

    <?= $form->field($model, 'is_agreest')->textInput() ?>

    <?= $form->field($model, 'is_quality')->textInput() ?>

    <?= $form->field($model, 'fee_return')->textInput() ?>

    <?= $form->field($model, 'audit_mem1')->textInput() ?>

    <?= $form->field($model, 'audit_mem2')->textInput() ?>

    <?= $form->field($model, 'audit_mem3')->textInput() ?>

    <?= $form->field($model, 'applicant')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'lastop_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
