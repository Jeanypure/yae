<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\VendorPoolSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-pool-search">

    <?php $form = ActiveForm::begin(); ?>

    <p><font color="red">创建新供应商前 按供应商名字搜下 如果已存在则不需创建 使用已存在的供应商代码等信息</font></p>

    <?= $form->field($model, 'supplier_name') ?>

    <div class="form-group">

        <?php echo  Html::button('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


