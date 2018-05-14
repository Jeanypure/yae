<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Preview */

$this->title = Yii::t('app', 'Create Preview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
