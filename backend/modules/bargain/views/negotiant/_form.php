<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\Negotiant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="negotiant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sku_code1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'negotiant')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
