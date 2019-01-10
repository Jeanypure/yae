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
        echo $form->field($model, 'pur_group')->widget(Select2::classname(), [
            'data' => [
                /* '1'=>'Emily',
                '2'=>'Bianca',
                '3'=>'Molly',
                '4'=>'Joe',
//                 '5'=>'Becky',
                '6'=>'Laura',
                '7'=>'Helen',
                '8'=>'Randy',*/
                '1'=>'1部',
                '2'=>'2部',
                '3'=>'3部',
                '4'=>'4部',
                '6'=>'6部',
                '7'=>'7部',
                '8'=>'8部',
            ],
            'options' => ['placeholder' => '选择销售公司.....'],
            'pluginOptions' => [
                'multiple' => true,
                'allowClear' => true
            ],
        ]);
        // Usage with ActiveForm and model
        echo $form->field($model, 'master_result')->widget(Select2::classname(), [
            'data' => [
                '0'=>'拒绝',
                '1'=>'采样',
                '2'=>'需议价或谈其他条件',
                '3'=>'未评审',
                '4'=>'直接下单',
                '5'=>'季节产品推迟',
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
        <?php

        // Usage with ActiveForm and model
        echo '<label class="control-label">流转新的部门评审</label>';

            echo $form->field($model, 'new_member')->widget(Select2::classname(), [
                'data' => $data,
                'value' => $model->new_member,
                'options' => [
                    //    'multiple' => true,
                    //    'onchange' => 'alert (this.value)',
                    'placeholder' => '如需要请选择其他部长评审 同时所属部门会改变...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);

        ?>

        <div class="form-group">
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-lg']) ?>
        </div>

        <?php ActiveForm::end(); ?>



    </div>


</div>
