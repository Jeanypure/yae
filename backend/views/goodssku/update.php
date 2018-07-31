<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */

$this->title = '更新: ' . $model->sku_id;
$this->params['breadcrumbs'][] = ['label' => 'Goodsskus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sku_id, 'url' => ['view', 'id' => $model->sku_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goodssku-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
