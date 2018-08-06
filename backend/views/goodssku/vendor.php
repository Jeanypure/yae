<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/4
 * Time: 11:43
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SkuVendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sku-vendor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sku_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'vendor_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_order_num')->textInput() ?>

    <?= $form->field($model, 'pd_get_days')->textInput() ?>

    <?= $form->field($model, 'pd_costprice_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pd_costprice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
