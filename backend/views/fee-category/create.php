<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FeeCategory */

$this->title = 'Create Fee Category';
$this->params['breadcrumbs'][] = ['label' => 'Fee Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
