<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/6/14
 * Time: 下午6:07
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
        'attributes'=>[       // 3 column layout
            'is_quality'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>可选的区域组",
                'items'=>[ 0=>'US',1=>'CA',2=>'AU',3=>'EUR',4=>'JP'],
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