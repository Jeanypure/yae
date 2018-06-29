<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = 'Update Yae Freight: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yae Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yae-freight-update">

    <?= $this->render('_form', [
        'model' => $model,
        'fee_model' => $fee_model[0],
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
