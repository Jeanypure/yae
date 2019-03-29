<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;

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
            'memo'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],
        ],

    ]);
    echo '<div class="col-sm-2"><label>申请日期</label>';
    echo DateTimePicker::widget([
        'name' => 'application_date',
        'options' => ['placeholder' => '--默认现在日期--','class'=>'form-control'],
        //注意，该方法更新的时候你需要指定value值
        'value' => date('Y-m-d'),
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd ',
            'todayHighlight' => true
        ]
    ]);
    echo '</div>';
    ?>
    <?php
    $res =$model->getSonList(0);
    echo '<div class="row"><div class="col-sm-2"><label>公司名</label>';
    echo  Html::activeDropDownList($model,'subsidiaries', $model->getSonList(0),
        ['prompt'=>'--请选分公司--','onchange'=>'$.post("'.yii::$app->urlManager->createUrl('/cost/domestic-freight/create').'?typeid=1&pid="+$(this).val(),function(data){var str="";$.each(data,function(k,v){str+="<option value="+v+">"+v+"</option>";});$("select#domesticfreight-group").html(str);})',
            'class'=>'form-control'
        ]);
    echo '<label>市场组</label>';
    echo Html::activeDropDownList($model,'group', $model->getSonList($model->subsidiaries),
        ['prompt'=>'--请选组别--',
            'class'=>'form-control'
        ]);
    echo '</div></div>';

    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
