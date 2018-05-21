<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeExchangeRate */

$this->title = Yii::t('app', 'Create Yae Exchange Rate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yae Exchange Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-exchange-rate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
