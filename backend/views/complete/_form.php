<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Complete */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complete-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_purchase_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_add_time')->textInput() ?>

    <?= $form->field($model, 'product_update_time')->textInput() ?>

    <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_pic_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_time')->textInput() ?>

    <?= $form->field($model, 'preview_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_company_id')->textInput() ?>

    <?= $form->field($model, 'group_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_time')->textInput() ?>

    <?= $form->field($model, 'group_update_time')->textInput() ?>

    <?= $form->field($model, 'group_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brocast_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url_low1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url_low2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url_low3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_url_low4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'complete_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
