<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\Crontab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crontab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crontab_str')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switch')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'last_rundate')->textInput() ?>

    <?= $form->field($model, 'next_rundate')->textInput() ?>

    <?= $form->field($model, 'execmemory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exectime')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
