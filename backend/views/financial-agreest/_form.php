<?php

use yii\helpers\Html;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pur-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>财务审核</h3></legend>',
        'attributes'=>[       // 3 column layout
            'fact_pay_amount'=>[
                'type'=>Form::INPUT_TEXT,
                'label'=>"<span style = 'color:red'><big>*</big></span>实际付款¥",
                'options'=>['placeholder'=>'',]
            ],
            'has_pay'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>是否付款",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
        ],

    ]);

    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
