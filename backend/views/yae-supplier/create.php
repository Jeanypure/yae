<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */

$this->title = 'Create Yae Supplier';
$this->params['breadcrumbs'][] = ['label' => 'Yae Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-supplier-create">

    <h6><?= Html::encode($this->title) ?></h6>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
