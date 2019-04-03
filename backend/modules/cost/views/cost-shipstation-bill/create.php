<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cost\models\CostShipstationBill */

$this->title = Yii::t('app', 'Create Cost Shipstation Bill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cost Shipstation Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-shipstation-bill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
