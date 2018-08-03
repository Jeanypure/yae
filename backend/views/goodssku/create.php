<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => '产品档案', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodssku-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
