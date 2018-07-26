<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NewContract */

$this->title = 'Create New Contract';
$this->params['breadcrumbs'][] = ['label' => 'New Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-contract-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
