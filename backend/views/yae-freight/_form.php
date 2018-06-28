<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-freight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'contentBefore'=>'<legend class="text-info"><h4>1.基本信息</h4></legend>',
        'attributes' => [
            'bill_to' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'receiver' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter password...']],
            'shipment_id' => ['type'=>Form::INPUT_TEXT],

        ]
    ]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'attributes' => [

            'pod' => ['type'=>Form::INPUT_TEXT],
            'pol' => ['type'=>Form::INPUT_TEXT],
            'etd' => ['type'=>Form::INPUT_TEXT],
            'eta' => ['type'=>Form::INPUT_TEXT],
        ]
    ]);

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'remark' => ['type'=>Form::INPUT_TEXTAREA],

        ]
    ]);


    ?>

    <?php
//    echo Html::label("<legend class='text-info'><small>费用信息</small></legend>");
    ?>

    <?php
    echo Form::widget([
        'model' => $fee_model,
        'form' => $form,
        'columns' => 6,
        'contentBefore'=>'<legend class="text-info"><h4>2.费用信息</h4></legend>',
        'attributes' => [
            'description_id' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter ...']],
            'quantity' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter ...']],
            'unit_price' => ['type'=>Form::INPUT_TEXT],
            'currency' => ['type'=>Form::INPUT_TEXT],
            'amount' => ['type'=>Form::INPUT_TEXT],

        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
   $(function() {
     $('h3').remove();
   });
JS;
$this->registerJs($js);
?>
