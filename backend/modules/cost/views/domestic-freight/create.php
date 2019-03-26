<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\DomesticFreight */

$this->title = 'Create Domestic Freight';
$this->params['breadcrumbs'][] = ['label' => 'Domestic Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domestic-freight-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
