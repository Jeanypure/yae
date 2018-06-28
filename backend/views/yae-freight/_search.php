<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreightSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-freight-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bill_to') ?>

    <?= $form->field($model, 'receiver') ?>

    <?= $form->field($model, 'shipment_id') ?>

    <?= $form->field($model, 'pod') ?>

    <?php // echo $form->field($model, 'pol') ?>

    <?php // echo $form->field($model, 'etd') ?>

    <?php // echo $form->field($model, 'eta') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
