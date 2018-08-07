<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Purchaser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchaser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>


    <?php
    echo  $form->field($model, 'role')->widget(Select2::classname(), [
        'data' => [
             '0'=>'采购',
             '1'=>'审核组',
             '3'=>'销售组长',
             '2'=>'销售部长',
        ],
        'options' => ['placeholder' => '人员角色'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    echo  $form->field($model, 'code')->widget(Select2::classname(), [
        'data' => [
             '1'=>'第一采购组',
             '2'=>'第二采购组',
             '3'=>'第三采购组',
        ],
        'options' => ['placeholder' => '采购组'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    echo  $form->field($model, 'has_used')->widget(Select2::classname(), [
        'data' => [
            '1'=>'在用',
            '0'=>'停用',
        ],
        'options' => ['placeholder' => '是否在用 0停用 1在用 '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    // Usage with ActiveForm and model
    echo $form->field($model, 'grade')->widget(Select2::classname(), [
        'data' => [
            '1.0'=>'1.0',
            '1.1'=>'1.1',
            '1.2'=>'1.2',
            '1.3'=>'1.3',
            '1.4'=>'1.4',
            '1.5'=>'1.5',

        ],
        'options' => ['placeholder' => '选择级别.....'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'memo')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
