<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MangerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preview-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'preview_id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'priview_time') ?>

    <?php // echo $form->field($model, 'member_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
