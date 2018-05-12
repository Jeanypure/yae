<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'product_title_en') ?>

    <?= $form->field($model, 'product_title') ?>

    <?= $form->field($model, 'product_purchase_value') ?>

    <?= $form->field($model, 'ref_url1') ?>

    <?php // echo $form->field($model, 'ref_url2') ?>

    <?php // echo $form->field($model, 'ref_url3') ?>

    <?php // echo $form->field($model, 'ref_url4') ?>

    <?php // echo $form->field($model, 'product_add_time') ?>

    <?php // echo $form->field($model, 'product_update_time') ?>

    <?php // echo $form->field($model, 'purchaser') ?>

    <?php // echo $form->field($model, 'creator') ?>

    <?php // echo $form->field($model, 'product_status') ?>

    <?php // echo $form->field($model, 'pd_pic_url') ?>

    <?php // echo $form->field($model, 'preview_time') ?>

    <?php // echo $form->field($model, 'preview_mark') ?>

    <?php // echo $form->field($model, 'sub_company') ?>

    <?php // echo $form->field($model, 'sub_company_id') ?>

    <?php // echo $form->field($model, 'group_mark') ?>

    <?php // echo $form->field($model, 'group_time') ?>

    <?php // echo $form->field($model, 'group_update_time') ?>

    <?php // echo $form->field($model, 'group_status') ?>

    <?php // echo $form->field($model, 'brocast_status') ?>

    <?php // echo $form->field($model, 'ref_url_low1') ?>

    <?php // echo $form->field($model, 'ref_url_low2') ?>

    <?php // echo $form->field($model, 'ref_url_low3') ?>

    <?php // echo $form->field($model, 'ref_url_low4') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
