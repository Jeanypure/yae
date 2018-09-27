<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\VendorPool */

$this->title = 'Create Vendor Pool';
$this->params['breadcrumbs'][] = ['label' => 'Vendor Pools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-pool-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
