<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = 'Create Pur Info';
$this->params['breadcrumbs'][] = ['label' => 'Pur Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
