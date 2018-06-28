<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yae Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-view">

    <p>
        <?php
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        echo Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'bill_to',
            'receiver',
            'shipment_id',
            'pod',
            'pol',
            'etd',
            'eta',
            'remark',
        ],
    ]) ?>

</div>
