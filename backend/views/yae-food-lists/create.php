<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeFoodLists */

$this->title = Yii::t('app', 'Create Yae Food Lists');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yae Food Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-food-lists-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
