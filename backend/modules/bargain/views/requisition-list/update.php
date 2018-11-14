<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionList */

$this->title = 'Update Requisition List: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisition Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="requisition-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
