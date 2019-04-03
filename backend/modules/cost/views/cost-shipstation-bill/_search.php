<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\CostShipstationBillSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cost-shipstation-bill-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'invoice') ?>

    <?= $form->field($model, 'subtotal') ?>

    <?= $form->field($model, 'exchange_rate') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'department') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
