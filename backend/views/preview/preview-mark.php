<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = Yii::t('app', '评审: {nameAttribute}', [
    'nameAttribute' => $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <h1>评审测试</h1>

    <div class="product-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'pd_pic_url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_title_en')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_purchase_value')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url3')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url4')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>  