<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NewContract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-contract-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'buy_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'declare_no1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'factory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_contract_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'declare_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
