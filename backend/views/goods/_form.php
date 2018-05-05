<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goodsname_cn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goodsname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail')->textInput() ?>

    <?= $form->field($model, 'link1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link3')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
