<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\DomesticFreightSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="domestic-freight-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dfid') ?>

    <?= $form->field($model, 'purchase_no') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'freight') ?>

    <?= $form->field($model, 'creator') ?>

    <?php // echo $form->field($model, 'applicant') ?>

    <?php // echo $form->field($model, 'subsidiaries') ?>

    <?php // echo $form->field($model, 'group') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'application_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
