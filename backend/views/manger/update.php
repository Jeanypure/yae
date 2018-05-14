<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Preview */

$this->title = Yii::t('app', 'Update Preview: ' . $model->preview_id, [
    'nameAttribute' => '' . $model->preview_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->preview_id, 'url' => ['view', 'id' => $model->preview_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="preview-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
