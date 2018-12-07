<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\Negotiant */

$this->title = 'Create Negotiant';
$this->params['breadcrumbs'][] = ['label' => 'Negotiants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negotiant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
