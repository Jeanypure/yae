<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisition-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tran_internal_id') ?>

    <?= $form->field($model, 'tranid') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'item_internal_id') ?>

    <?php // echo $form->field($model, 'item_name') ?>

    <?php // echo $form->field($model, 'linkedorder_internalid') ?>

    <?php // echo $form->field($model, 'linkedorder_name') ?>

    <?php // echo $form->field($model, 'linkedorderstatus') ?>

    <?php // echo $form->field($model, 'povendor_internalid') ?>

    <?php // echo $form->field($model, 'povendor_name') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'lastmodifieddate') ?>

    <?php // echo $form->field($model, 'trandate') ?>

    <?php // echo $form->field($model, 'currencyname') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
