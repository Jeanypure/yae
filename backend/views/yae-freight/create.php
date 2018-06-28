<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = 'Create Yae Freight';
$this->params['breadcrumbs'][] = ['label' => 'Yae Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-create">

<?= $this->render('_form', [
        'model' => $model,
        'fee_model' => $fee_model[0],
    ]) ?>

</div>
