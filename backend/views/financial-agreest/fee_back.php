<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Sample */

//$this->title = $model->sample_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pur-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model'=>$sample_model,
        'form'=>$form,
        'columns'=>3,
        'contentBefore'=>'<legend class="text-info"><h3>样品退款审核</h3></legend>',
        'attributes'=>[       // 3 column layout
            'fact_refund'=>[
                'type'=>Form::INPUT_TEXT,
                'label'=>"<span style = 'color:red'><big>*</big></span>实际退款¥",
                'options'=>['placeholder'=>'',]
            ],
            'has_refund'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'label'=>"<span style = 'color:red'><big>*</big></span>是否退费到账?",
                'options'=>['placeholder'=>'',]
            ],

            'sure_refund_men'=>[
                'type'=>Form::INPUT_HIDDEN,
                'options'=>['placeholder'=>'',]
            ],
        ],

    ]);
    echo Form::widget([
        'model'=>$sample_model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[       // 3 column layout
          'sure_remark'=>[
                'type'=>Form::INPUT_TEXTAREA,
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


<div class="sample-view">

    <?= DetailView::widget([
        'model' => $sample_model,
        'attributes' => [
            'procurement_cost',
            'sample_freight',
            'else_fee',
            'pay_amount',
            'pay_way',
            'mark',
            'is_audit',
            [
              'attribute'=> 'is_agreest',
              'value'=> function($model){
                    if($model->is_agreest==1){
                        return '同意';
                    }else{
                        return '不同意';
                    }
              },
            ],

            [
                'attribute'=> 'fee_return',
                'value'=> function($model){
                    if($model->fee_return==1){
                        return '是';
                    }else{
                        return '否';
                    }
                },
            ],
//            'audit_mem1',
//            'audit_mem2',
//            'audit_mem3',
//            'applicant',
//            'purchaser',
            'create_date',
//            'lastop_date',
        ],
    ]) ?>

</div>
