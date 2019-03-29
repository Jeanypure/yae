<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\DomesticFreight */

$this->title = '更新 ' . $model->dfid;
$this->params['breadcrumbs'][] = ['label' => '国内运费列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dfid, 'url' => ['view', 'id' => $model->dfid]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="domestic-freight-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
