<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FeeCategory */

$this->title = 'Update Fee Category: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fee Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fee-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
