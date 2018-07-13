<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */

$this->title = '审核: ' . $model->supplier_name;
$this->params['breadcrumbs'][] = ['label' => 'Yae Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yae-supplier-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
