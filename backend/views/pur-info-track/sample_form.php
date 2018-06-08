<?php
use yii\helpers\Html;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>2.样品费用信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'procurement_cost'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'sample_freight'=>['type'=>Form::INPUT_TEXT,
                'labelOptions'=>['class'=>'label-require'],
                'options'=>['placeholder'=>'','class'=>'label-require']],
            'else_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pay_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pay_way'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'mark'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'is_audit'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'is_agreest'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'is_audit'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'is_quality'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'fee_return'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
//            is_quality,fee_return,audit_mem1,audit_mem2,audit_mem3,applicant
        ],

    ]);

    ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
