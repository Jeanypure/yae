<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model backend\models\Preview */

$this->title = Yii::t('app', 'Create Preview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preview-create">


    <div class="preview-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member')->textInput(['maxlength' => true])
            ->hiddenInput(['value'=>Yii::$app->user->identity->username])->label(false); ?>

        <?= $form->field($model, 'product_id')->textInput(['value' => $id ])
        ->hiddenInput(['value'=>$id])->label(false);?>

        <?php
        // Usage with ActiveForm and model
        echo $form->field($model, 'result')->widget(Select2::classname(), [
            'data' => [
                    '采样'=>'采样',
                    '拒绝'=>'拒绝',
                    '可以开发'=>'可以开发',
                ],
            'options' => ['placeholder' => '选择结果.....'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>

        <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>


        <?= $form->field($model, 'priview_time')->textInput()->hiddenInput([])->label(false) ?>

        <?= $form->field($model, 'member_id')->textInput()
            ->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

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
