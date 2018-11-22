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

    <?= $form->field($model, 'linkedorder_internalid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkedorder_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkedorderstatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'povendor_internalid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'povendor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createdate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastmodifieddate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trandate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currencyname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
