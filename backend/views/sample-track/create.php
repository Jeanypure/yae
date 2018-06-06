<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SampleTrack */

$this->title = Yii::t('app', 'Create Sample Track');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sample Tracks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-track-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
