<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = Yii::t('app', 'Audit Product: ' . $model->product_id, [
    'nameAttribute' => '' . $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Audit');
?>
<div class="product-audit">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


<!--    <div class="preview-form">-->
<!---->
<!--        --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--        --><?//= $form->field($model, 'member')->textInput(['maxlength' => true]) ?>
<!---->
<!--        --><?//= $form->field($model, 'product_id')->textInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>
<!---->
<!--        --><?//= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>
<!---->
<!--        --><?//= $form->field($model, 'priview_time')->textInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'member_id')->textInput() ?>
<!---->
<!--        <div class="form-group">-->
<!--            --><?//= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
<!--        </div>-->
<!---->
<!--        --><?php //ActiveForm::end(); ?>
<!---->
<!--    </div>-->

</div>
