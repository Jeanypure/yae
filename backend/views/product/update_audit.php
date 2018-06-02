<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/5/14
 * Time: 下午12:00
 */

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Preview */

$this->title = Yii::t('app', '更新评审: ' . $model->preview_id, [
    'nameAttribute' => '' . $model->preview_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->preview_id, 'url' => ['view', 'id' => $model->preview_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="preview-update">

    <h1><?php
//        echo  Html::encode($this->title);
        ?></h1>

    <div class="preview-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member')->textInput(['maxlength' => true])->hiddenInput([])->label(false);?>
        <?= $form->field($model, 'product_id')->textInput() ->hiddenInput([])->label(false);?>

        <?php
        // Usage with ActiveForm and model
        echo $form->field($model, 'result')->widget(Select2::classname(), [
            'data' => [
                '1'=>'采样',
                '0'=>'拒绝',
                '2'=>'可以开发',
            ],
            'options' => ['placeholder' => '选择结果.....'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>
        <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>


        <?= $form->field($model, 'priview_time')->textInput() ->hiddenInput([])->label(false);?>

        <?= $form->field($model, 'member_id')->textInput() ->hiddenInput([])->label(false);?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
