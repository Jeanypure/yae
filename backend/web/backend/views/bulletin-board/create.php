<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BulletinBoard */

$this->title = Yii::t('app', 'Create Bulletin Board');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bulletin Boards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulletin-board-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
