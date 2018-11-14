<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionList */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisition Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'internal_id',
            'requisition_date',
            'document_number',
            'requisition_name',
            'status',
            'memo',
            'amount',
            'currency',
            'get_record_time',
            'push_record_time',
            'update_record_time',
        ],
    ]) ?>

</div>
