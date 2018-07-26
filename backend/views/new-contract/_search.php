<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NewContractSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-contract-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'buy_company') ?>

    <?= $form->field($model, 'declare_no1') ?>

    <?= $form->field($model, 'project_no') ?>

    <?= $form->field($model, 'factory') ?>

    <?php // echo $form->field($model, 'purchase_contract_no') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'declare_no') ?>

    <?php // echo $form->field($model, 'purchaser') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
