<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\CostTongtoolBillSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cost-tongtool-bill-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bill_no') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'born_date') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'payment_platform') ?>

    <?php // echo $form->field($model, 'department') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
