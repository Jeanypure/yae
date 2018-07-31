<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */

$this->title = '创建产品档案';
$this->params['breadcrumbs'][] = ['label' => 'Goodsskus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodssku-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
