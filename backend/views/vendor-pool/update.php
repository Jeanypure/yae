<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorPool */

$this->title = 'Update Vendor Pool: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Pools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendor-pool-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
