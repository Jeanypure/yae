<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goodssku-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h2>5 审核记录</h2></legend>',
        'attributes'=>[       // 3 column layout
            'audit_result'=>['type'=>Form::INPUT_RADIO_LIST, 'items'=>[1=>'是', 2=>'否'],
                'label'=>"<span style = 'color:red'><big>*</big></span>是否通过",],
        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 3 column layout
            'audit_content'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],
        ],

    ]);




    ?>


    <div class="form-group">
        <?php
        echo  Html::submitButton('Save', ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
