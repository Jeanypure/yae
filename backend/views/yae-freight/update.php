<?php


/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = '更新货代单: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yae Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="yae-freight-update">

    <?= $this->render('_form', [
        'model' => $model,
        'param' => $param,

    ]) ?>


    <?php

    echo $this->render('fee_form',[
        'model' => $model,
        'fee_model' => $fee_model[0],
        'id' => 'fee-detail',
        'dataProvider' => $dataProvider,

    ])
    ?>
    <?php
        echo  $this->render('total_view',['total' => $total])
    ?>
</div>
