<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetail */

$this->title = '更新请购产品: ' . $model->item_name;
$this->params['breadcrumbs'][] = ['label' => '请购产品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="requisition-detail-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
