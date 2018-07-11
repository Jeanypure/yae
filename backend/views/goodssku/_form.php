<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goodssku-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'declared_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_quantity_check')->textInput() ?>

    <?= $form->field($model, 'contain_battery')->textInput() ?>

    <?= $form->field($model, 'qty_of_ctn')->textInput() ?>

    <?= $form->field($model, 'ctn_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ctn_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ctn_height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ctn_fact_weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sale_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_order_num')->textInput() ?>

    <?= $form->field($model, 'pd_get_days')->textInput() ?>

    <?= $form->field($model, 'pd_costprice_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_costprice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pur_info_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
