<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Purchaser */

$this->title = Yii::t('app', 'Create Purchaser');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchasers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchaser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
