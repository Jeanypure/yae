<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\DomesticFreight */

$this->title = $model->dfid;
$this->params['breadcrumbs'][] = ['label' => 'Domestic Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domestic-freight-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dfid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dfid], [
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
            'dfid',
            'purchase_no',
            'sku',
            'freight',
            'creator',
            'applicant',
            'subsidiaries',
            'group',
            'create_date',
            'application_date',
        ],
    ]) ?>

</div>
