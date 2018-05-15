<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Complete */

$this->title = Yii::t('app', 'Create Complete');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Completes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complete-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
