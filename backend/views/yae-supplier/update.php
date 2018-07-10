<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */

$this->title = 'Update Yae Supplier: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yae Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yae-supplier-update">

    <h6><?= Html::encode($this->title) ?></h6>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
