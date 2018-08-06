<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/6
 * Time: 14:46
 */
use yii\helpers\Html;
use yii\helpers\Url;
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
        'columns'=>4,
//        'contentBefore'=>'<legend class="text-info"><h3>到货审核</h3></legend>',
        'attributes'=>[       // 3 column layout
            'has_arrival'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>是否到货",
                'items'=>[1=>'已到货', 0=>'未到'],
                'options'=>['placeholder'=>'',]
            ],



            'write_date'=>[
                    'type'=>Form::INPUT_TEXT,
                    'label'=>"<span style = 'color:red'><big>*</big></span>到货日期",
                    'options'=>['placeholder'=>'']],
            'minister_result'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>部长判断",
                'items'=>[1=>'半价产品',1=>'半价产品',2=>'新品',3=>'推送产品',4=>'简单重复'],
                'options'=>['placeholder'=>'',]
            ],
            'minister_reason'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

            'spur_info_id'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],
        ],

    ]);

    ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>


