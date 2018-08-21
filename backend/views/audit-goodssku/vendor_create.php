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

$this->title = 'Create Sku Vendor';
$this->params['breadcrumbs'][] = ['label' => 'Sku Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sku-vendor-create">

    <?= $this->render('vendor', [
        'model' => $model,

    ]) ?>

</div>
