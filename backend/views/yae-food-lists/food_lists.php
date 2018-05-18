<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
header("Content-type: text/html; charset=utf-8");


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '可以从下列表选择食物');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-create">



    <div class="pur-info-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'food_name'

            )->radioList($food

            ) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
