<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = Yii::t('app', '分部产品 : {nameAttribute}', [
    'nameAttribute' => $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '分部产品'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', '更新');
?>
<div class="group-update">

    <img src="<?= Html::encode($model->pd_pic_url)?>" height="100" width="100"/>
    <div class="group-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-lg']) ?>
        </div>
        <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'sub_company')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => '选择分部.....'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);

        ?>

        <?= $form->field($model, 'group_mark')->textarea(['rows' => '6']) ?>

        <?php
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
            'attributes'=>[       // 3 column layout
                'product_title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'product_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'product_purchase_value'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_pic_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'地址格式:https://XXXX.jpg|png|gif等']],

            ],

        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'contentBefore'=>'<legend class="text-info"><h3>2.链接信息</h3></legend>',
            'attributes'=>[       // 3 column layout
                'ref_url1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url2'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url3'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url4'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

            ],

        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[       // 3 column layout
                'creator'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ],

        ]);
        ?>

        <?php ActiveForm::end(); ?>

    </div>


</div>




