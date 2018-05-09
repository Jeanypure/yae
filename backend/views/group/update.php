<?php

use yii\helpers\Html;
use kartik\select2\Select2;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = Yii::t('app', 'Update Product: {nameAttribute}', [
    'nameAttribute' => $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'sub_company')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'product_title_en')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_purchase_value')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url3')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ref_url4')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_add_time')->textInput() ?>

        <?= $form->field($model, 'product_update_time')->textInput() ?>

        <?= $form->field($model, 'purchaser')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pd_pic_url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'preview_mark')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


    <?php
//    echo $this->render('_form', ['model' => $model,]) ;
    ?>

</div>




