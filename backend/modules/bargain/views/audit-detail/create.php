<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetail */

$this->title = 'Create Requisition Detail';
$this->params['breadcrumbs'][] = ['label' => 'Requisition Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
