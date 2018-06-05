<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/5/14
 * Time: 下午12:00
 */

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\ActiveForm;

use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

?>
<div class="pur-info-update">


    <div class="pur-info-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member')->textInput(['maxlength' => true])->hiddenInput([])->label(false);?>
        <?= $form->field($model, 'pur_info_id')->textInput() ->hiddenInput([])->label(false);?>
        <?= $form->field($model, 'priview_time')->textInput() ->hiddenInput([])->label(false);?>
        <?= $form->field($model, 'master_member')->textInput() ->hiddenInput([])->label(false);?>

        <?php
        // Usage with ActiveForm and model
        echo $form->field($model, 'master_result')->widget(Select2::classname(), [
            'data' => [
                '0'=>'拒绝',
                '1'=>'采样',
                '2'=>'可以开发',
                '3'=>'未评审',
                '4'=>'直接下单',
                '5'=>'季节产品推迟',
                '6'=>'需议价或谈其他条件',
            ],
            'options' => ['placeholder' => '选择结果.....'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>

        <?php
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[       // 1 column layout
                'master_mark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'','style'=>'height:100px']],
            ]
        ]);
        ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-lg']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
