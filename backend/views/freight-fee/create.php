<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FreightFee */

$this->title = 'Create Freight Fee';
$this->params['breadcrumbs'][] = ['label' => 'Freight Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-fee-create">


    <?= $this->render('_form', [
        'model' => $model,
        'fee_category' => $fee_category,
    ]) ?>

</div>
