<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\LotnumberedInventoryItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lotnumbered-inventory-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'internalid') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'property') ?>

    <?= $form->field($model, 'bargain') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
