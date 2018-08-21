<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/4
 * Time: 11:44
 */


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SkuVendor */

$this->title = 'Update Sku Vendor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sku Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sku-vendor-update">


    <?= $this->render('vendor', [
        'model' => $model,
    ]) ?>

</div>
