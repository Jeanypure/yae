<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model backend\models\Preview */

$this->title = Yii::t('app', 'Create Preview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="preview-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_id')->textInput() ?>

        <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'priview_time')->textInput() ?>

        <?= $form->field($model, 'member_id')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


    <?php
//    echo $this->render('_form', [
//        'model' => $model,
//    ]);
    ?>

</div>
