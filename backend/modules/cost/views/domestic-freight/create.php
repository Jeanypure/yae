<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\DomesticFreight */

$this->title = '创建国内运费';
$this->params['breadcrumbs'][] = ['label' => '国内运费列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domestic-freight-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
