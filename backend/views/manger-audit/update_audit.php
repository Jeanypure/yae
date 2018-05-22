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
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '更新评审: ' . $model->pur_info_id, [
'nameAttribute' => '' . $model->pur_info_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pur_info_id, 'url' => ['view', 'id' => $model->pur_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pur-info-update">


    <div class="pur-info-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member')->textInput(['maxlength' => true])->hiddenInput([])->label(false);?>
        <?= $form->field($model, 'pur_info_id')->textInput() ->hiddenInput([])->label(false);?>

        <?php
        // Usage with ActiveForm and model
        echo $form->field($model, 'master_result')->widget(Select2::classname(), [
            'data' => [
                ''=>'',
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
        <?= $form->field($model, 'master_mark')->textarea(['maxlength' => true]) ?>


        <?= $form->field($model, 'priview_time')->textInput() ->hiddenInput([])->label(false);?>

        <?= $form->field($model, 'master_member')->textInput() ->hiddenInput([])->label(false);?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
