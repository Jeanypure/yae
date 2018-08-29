<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */

$this->title = '创建供应商';
$this->params['breadcrumbs'][] = ['label' => '供应商列表 ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-supplier-create">


    <?= $this->render('_form', [
        'model' => $supplier,
        'supplier_contact' => $supplier_contact,
    ]) ?>

</div>
