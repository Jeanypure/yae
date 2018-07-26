<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\NewContract */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'New Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-contract-view">

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
            'buy_company',
            'declare_no1',
            'project_no',
            'factory',
            'purchase_contract_no',
            'product_name',
            'unit',
            'quantity',
            'amount',
            'declare_no',
            'purchaser',
            'sku',
        ],
    ]) ?>

</div>
