<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisition Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-detail-view">

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
            'tran_internal_id',
            'tranid',
            'amount',
            'description',
            'item_internal_id',
            'item_name',
            'povendor_internalid',
            'povendor_name',
            'quantity',
            'rate',
            'createdate',
            'lastmodifieddate',
            'trandate',
            'currencyname',
            'supplier_name',
            'contact_name',
            'contact_tel',
            'contact_qq',
            'bill_type',
            'arrival_data',
            'payment_method',
            'negotiant',
            'commit_time',
            'commit_status',
            'audit_time',
            'audit_status',
        ],
    ]) ?>

</div>
