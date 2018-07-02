<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\ActiveForm;

use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model backend\models\FreightFee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="freight-fee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'freight_id')->textInput() ?>


    <?php
    // Usage with ActiveForm and model
    echo $form->field($model, 'description_id')->widget(Select2::classname(), [
        'data' => $fee_category,
        'options' => ['placeholder' => '选择费用.....'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?php
    // Usage with ActiveForm and model
    echo $form->field($model, 'currency')->widget(Select2::classname(), [
        'data' => [
            '0'=>'USD',
            '1'=>'GBP',
            '2'=>'CAD',
            '3'=>'EUR',

        ],
        'options' => ['placeholder' => '选择币种.....'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

     <?php
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[       // 1 column layout
                'ramark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'','style'=>'height:100px']],
            ]
        ]);
        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
