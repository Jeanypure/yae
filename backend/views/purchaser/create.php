<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Purchaser */

$this->title = Yii::t('app', '添加');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchasers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchaser-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
