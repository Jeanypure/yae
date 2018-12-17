<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\LotnumberedInventoryItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lotnumbered-inventory-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property')->textInput(['maxlength' => true]) ?>

    <?php
    // Usage with ActiveForm and model
    echo $form->field($model, 'bargain')->widget(Select2::classname(), [
        'data' => $negotiant,
        'options' => ['placeholder' => '选择议价人.....'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
