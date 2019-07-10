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



    <?= $form->field($model, 'supplier_name') ?>

    <div class="form-group">

        <?php echo  Html::button('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


