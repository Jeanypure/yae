<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = 'Update Pur Info: ' . $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => 'Pur Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pur_info_id, 'url' => ['view', 'id' => $model->pur_info_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pur-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
