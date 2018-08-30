<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;



/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-freight-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <legend class="text-info"><h4>1.基本信息</h4></legend>
    <div class="row">
        <div class="col-sm-3">
            <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'bill_to')->widget(Select2::classname(), [
                'data' => $param['full_name'],
                'options' => ['placeholder' => '选择付款公司.....'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>
        <div class="col-sm-3">
            <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'receiver')->widget(Select2::classname(), [
                'data' => $param['receiver'],
                'options' => ['placeholder' => '选择货代公司.....'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>
        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 3,
            'attributes' => [
                'contract_no' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'debit_no' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'shipment_id' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'多个 Shipment ID , 号分割']],

            ]
        ]);

        ?>

    </div>
    <?php

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



        echo $form->field($model, 'image')->widget('manks\FileInput', []);

        ?>
    <?php
    // Usage with ActiveForm and model
    echo $form->field($model, 'minister')->widget(Select2::classname(), [
        'data' => $param['minister'],
        'options' => ['multiple' => false,'placeholder' => '选择销售.....'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

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
