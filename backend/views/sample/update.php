<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sample */

$this->title = Yii::t('app', 'Update Sample: ' . $model->sample_id, [
    'nameAttribute' => '' . $model->sample_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sample_id, 'url' => ['view', 'id' => $model->sample_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sample-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
