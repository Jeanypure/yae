<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\DomesticFreight */

$this->title = 'Update Domestic Freight: ' . $model->dfid;
$this->params['breadcrumbs'][] = ['label' => 'Domestic Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dfid, 'url' => ['view', 'id' => $model->dfid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="domestic-freight-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
