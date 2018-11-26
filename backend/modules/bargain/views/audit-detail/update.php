<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetail */

$this->title = '审核请购产品: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisition Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="requisition-detail-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
