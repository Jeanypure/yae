<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/6/12
 * Time: 上午10:41
 */
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
//        'contentBefore'=>'<legend class="text-info"><h3>1.样品审核</h3></legend>',
        'attributes'=>[       // 3 column layout
//            'is_agreest'=>[
//                'type'=>Form::INPUT_RADIO_LIST,
//                'label'=>"<span style = 'color:red'><big>*</big></span>是否同意支付样品费",
//                'items'=>[1=>'是', 0=>'否'],
//                'options'=>['placeholder'=>'',]
//            ],

            'is_quality'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>质量是否合格",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],

//            'is_purchase'=>[
//                'type'=>Form::INPUT_RADIO_LIST,
//                'label'=>"<span style = 'color:red'><big>*</big></span>是否采购",
//                'items'=>[1=>'是', 0=>'否'],
//                'options'=>['placeholder'=>'',]
//            ],

//            'spur_info_id'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],

//            is_quality,fee_return,audit_mem1,audit_mem2,audit_mem3,applicant
        ],

    ]);

    ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>