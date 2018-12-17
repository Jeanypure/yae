<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\LotnumberedInventoryItem */

$this->title = 'Update SKU议价人: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'SKU议价人', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lotnumbered-inventory-item-update">

    <?= $this->render('_form', [
        'model' => $model,
        'negotiant' =>$negotiant
    ]) ?>

</div>
