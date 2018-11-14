<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisition-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'internal_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requisition_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requisition_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'get_record_time')->textInput() ?>

    <?= $form->field($model, 'push_record_time')->textInput() ?>

    <?= $form->field($model, 'update_record_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
