<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/5/12
 * Time: 上午11:44
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '评审: ' . $model->pur_info_id, [
    'nameAttribute' => '' . $model->pur_info_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '评审信息'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pur_info_id, 'url' => ['view', 'id' => $model->pur_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pur-info-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="pur-info-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'pur_responsible_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pur_group')->textInput() ?>

        <?= $form->field($model, 'pd_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pd_title_en')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pd_pic_url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pd_package')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pd_length')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pd_width')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pd_height')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parent_product_id')->textInput() ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>



</div>
