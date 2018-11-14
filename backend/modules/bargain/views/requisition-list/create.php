<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionList */

$this->title = 'Create Requisition List';
$this->params['breadcrumbs'][] = ['label' => 'Requisition Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
