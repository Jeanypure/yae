<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = Yii::t('app', '分组产品 : {nameAttribute}', [
    'nameAttribute' => $model->product_title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '分组产品'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', '更新');
?>
<div class="group-update">

    <img src="<?= Html::encode($model->pd_pic_url)?>" height="100" width="100"/>
    <div class="group-form">

        <?php $form = ActiveForm::begin(); ?>
        <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'sub_company')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => '选择分组.....'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);

        ?>

        <?= $form->field($model, 'group_mark')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_title_en')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_purchase_value')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url3')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url4')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url_low1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url_low2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url_low3')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url_low4')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_add_time')->textInput() ?>

        <?= $form->field($model, 'product_update_time')->textInput() ?>

        <?= $form->field($model, 'pd_pic_url')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>




