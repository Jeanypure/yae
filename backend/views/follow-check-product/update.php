<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */

$this->title = '查新品:' . $model->sku_id;
$this->params['breadcrumbs'][] = ['label' => '产品档案', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sku_id, 'url' => ['view', 'id' => $model->sku_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goodssku-update">
<p>
    <img src="<?php echo $model->image_url ?>" alt="" height="100" width="100">
</p>

    <?= $this->render('_form', [
        'model' => $model,
        'sku_vendor' => $sku_vendor
    ]) ?>



</div>
