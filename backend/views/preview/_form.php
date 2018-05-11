<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pd_pic_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_purchase_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>