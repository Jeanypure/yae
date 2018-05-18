<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeUserFood */

$this->title = Yii::t('app', 'Create Yae User Food');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yae User Foods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-user-food-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
