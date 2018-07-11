<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsskuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goodssku-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sku_id') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'declared_value') ?>

    <?= $form->field($model, 'currency_code') ?>

    <?= $form->field($model, 'old_sku') ?>

    <?php // echo $form->field($model, 'is_quantity_check') ?>

    <?php // echo $form->field($model, 'contain_battery') ?>

    <?php // echo $form->field($model, 'qty_of_ctn') ?>

    <?php // echo $form->field($model, 'ctn_length') ?>

    <?php // echo $form->field($model, 'ctn_width') ?>

    <?php // echo $form->field($model, 'ctn_height') ?>

    <?php // echo $form->field($model, 'ctn_fact_weight') ?>

    <?php // echo $form->field($model, 'sale_company') ?>

    <?php // echo $form->field($model, 'vendor_code') ?>

    <?php // echo $form->field($model, 'origin_code') ?>

    <?php // echo $form->field($model, 'min_order_num') ?>

    <?php // echo $form->field($model, 'pd_get_days') ?>

    <?php // echo $form->field($model, 'pd_costprice_code') ?>

    <?php // echo $form->field($model, 'pd_costprice') ?>

    <?php // echo $form->field($model, 'bill_name') ?>

    <?php // echo $form->field($model, 'bill_unit') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'sku_mark') ?>

    <?php // echo $form->field($model, 'pur_info_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
