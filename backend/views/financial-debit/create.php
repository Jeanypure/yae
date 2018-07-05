<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = 'Create Yae Freight';
$this->params['breadcrumbs'][] = ['label' => 'Yae Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
