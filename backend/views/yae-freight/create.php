<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = 'Create  Freight';
$this->params['breadcrumbs'][] = ['label' => 'Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-create">

<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
