<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\NewContract */

$this->title = 'Update New Contract: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'New Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="new-contract-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
