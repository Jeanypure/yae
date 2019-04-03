<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\CostTongtoolBill */

$this->title = Yii::t('app', 'Create Cost Tongtool Bill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cost Tongtool Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-tongtool-bill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
