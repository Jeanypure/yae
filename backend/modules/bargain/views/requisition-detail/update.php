<?php

use yii\helpers\Html;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetail */

$this->title = '产品详情: ' . $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Requisition Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="requisition-detail-update">


    <?= $this->render('_form', [
        'model' => $model,
        'vendor_detail' => $vendor_detail
    ]) ?>

</div>
