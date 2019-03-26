<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\DomesticFreight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="domestic-freight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'purchase_no'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'sku'=>['type'=>Form::INPUT_TEXT,
                'labelOptions'=>['class'=>'label-require'],
                'options'=>['placeholder'=>'','class'=>'label-require']],
            'freight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'subsidiaries'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'group'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'application_date'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],

    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
