<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DepartmentDebitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-freight-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
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

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'to_minister') ?>

    <?php // echo $form->field($model, 'to_financial') ?>

    <?php // echo $form->field($model, 'mini_deal') ?>

    <?php // echo $form->field($model, 'fina_deal') ?>

    <?php // echo $form->field($model, 'mini_res') ?>

    <?php // echo $form->field($model, 'fina_res') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
