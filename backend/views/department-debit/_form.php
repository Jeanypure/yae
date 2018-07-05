<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-freight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bill_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'etd')->textInput() ?>

    <?= $form->field($model, 'eta')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_minister')->textInput() ?>

    <?= $form->field($model, 'to_financial')->textInput() ?>

    <?= $form->field($model, 'mini_deal')->textInput() ?>

    <?= $form->field($model, 'fina_deal')->textInput() ?>

    <?= $form->field($model, 'mini_res')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fina_res')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
