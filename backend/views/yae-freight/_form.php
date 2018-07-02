<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\editable\Editable;
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

    <div class="col-sm-4">
        <div class="form-group">
            <?php
            // An advanced usage using a datepicker widget from kartik\widgets and
            // additional content rendered after the input using a Closure callback
            echo '<label>ETD</label><br>';
            echo Editable::widget([
                'model'=>$model,
                'attribute'=>'etd',
                'header' => 'ETD',
                'asPopover' => true,
                'size'=>'md',
                'inputType' => Editable::INPUT_DATE,
                'options'=>[
                    'options'=>['placeholder'=>'From date']
                ]
            ]);
            echo '<label>ETA</label><br>';
            echo Editable::widget([
                'model'=>$model,
                'attribute'=>'eta',
                'header' => 'Date Range',
                'asPopover' => true,
                'afterInput'=>function($form, $widget) {
                    echo $form->field($widget->model, 'eta')->widget(\kartik\widgets\DatePicker::classname(), [
                        'options'=>['placeholder'=>'To date']
                    ])->label(false);
                },
                'size'=>'md',
                'inputType' => Editable::INPUT_DATE,
                'options'=>[
                    'options'=>['placeholder'=>'From date']
                ]
            ]);

            ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-lg']) ?>
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
