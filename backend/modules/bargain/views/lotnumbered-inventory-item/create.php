<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\LotnumberedInventoryItem */

$this->title = 'Create SKU议价人';
$this->params['breadcrumbs'][] = ['label' => 'SKU议价人', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lotnumbered-inventory-item-create">

    <?= $this->render('_form', [
        'model' => $model,
        'negotiant' =>$negotiant
    ]) ?>

</div>
