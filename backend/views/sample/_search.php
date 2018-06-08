<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SampleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sample_id') ?>

    <?= $form->field($model, 'spur_info_id') ?>

    <?= $form->field($model, 'procurement_cost') ?>

    <?= $form->field($model, 'sample_freight') ?>

    <?= $form->field($model, 'else_fee') ?>

    <?php // echo $form->field($model, 'pay_amount') ?>

    <?php // echo $form->field($model, 'pay_way') ?>

    <?php // echo $form->field($model, 'mark') ?>

    <?php // echo $form->field($model, 'is_audit') ?>

    <?php // echo $form->field($model, 'is_agreest') ?>

    <?php // echo $form->field($model, 'is_quality') ?>

    <?php // echo $form->field($model, 'fee_return') ?>

    <?php // echo $form->field($model, 'audit_mem1') ?>

    <?php // echo $form->field($model, 'audit_mem2') ?>

    <?php // echo $form->field($model, 'audit_mem3') ?>

    <?php // echo $form->field($model, 'applicant') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'lastop_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
