<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\CrontabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crontab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'route') ?>

    <?= $form->field($model, 'crontab_str') ?>

    <?= $form->field($model, 'switch') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'last_rundate') ?>

    <?php // echo $form->field($model, 'next_rundate') ?>

    <?php // echo $form->field($model, 'execmemory') ?>

    <?php // echo $form->field($model, 'exectime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
