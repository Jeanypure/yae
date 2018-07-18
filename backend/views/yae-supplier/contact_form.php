<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\models\SupplierContact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
//        'contentBefore'=>'<legend class="text-info"><h3>1.供应商基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'contact_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_tel'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_address'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_qq'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
//        'contentBefore'=>'<legend class="text-info"><h3>1.供应商基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'contact_wechat'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_wangwang'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'skype'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_memo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);

    ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
