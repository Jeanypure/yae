<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\assignTaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pur-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'pur_info_id') ?>

    <?= $form->field($model, 'purchaser') ?>

    <?= $form->field($model, 'pur_group') ?>

    <?= $form->field($model, 'pd_title') ?>

    <?= $form->field($model, 'pd_title_en') ?>

    <?php // echo $form->field($model, 'pd_pic_url') ?>

    <?php // echo $form->field($model, 'pd_package') ?>

    <?php // echo $form->field($model, 'pd_length') ?>

    <?php // echo $form->field($model, 'pd_width') ?>

    <?php // echo $form->field($model, 'pd_height') ?>

    <?php // echo $form->field($model, 'is_huge') ?>

    <?php // echo $form->field($model, 'pd_weight') ?>

    <?php // echo $form->field($model, 'pd_throw_weight') ?>

    <?php // echo $form->field($model, 'pd_count_weight') ?>

    <?php // echo $form->field($model, 'pd_material') ?>

    <?php // echo $form->field($model, 'pd_purchase_num') ?>

    <?php // echo $form->field($model, 'pd_pur_costprice') ?>

    <?php // echo $form->field($model, 'has_shipping_fee') ?>

    <?php // echo $form->field($model, 'bill_type') ?>


    <?php // echo $form->field($model, 'hs_code') ?>

    <?php // echo $form->field($model, 'bill_tax_rebate') ?>

    <?php // echo $form->field($model, 'bill_rebate_amount') ?>

    <?php // echo $form->field($model, 'no_rebate_amount') ?>

    <?php // echo $form->field($model, 'retail_price') ?>

    <?php // echo $form->field($model, 'ebay_url') ?>

    <?php // echo $form->field($model, 'amazon_url') ?>

    <?php // echo $form->field($model, 'url_1688') ?>

    <?php // echo $form->field($model, 'shipping_fee') ?>

    <?php // echo $form->field($model, 'oversea_shipping_fee') ?>

    <?php // echo $form->field($model, 'transaction_fee') ?>

    <?php // echo $form->field($model, 'gross_profit') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'parent_product_id') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'member') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
