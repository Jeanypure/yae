<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Complete */

$this->title = Yii::t('app', 'Update Complete: ' . $model->product_id, [
    'nameAttribute' => '' . $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Completes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="complete-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
