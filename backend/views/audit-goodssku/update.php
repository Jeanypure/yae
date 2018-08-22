<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */

$this->title = '更新:' . $model->sku_id;
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
    ]) ?>
    <?= $this->render('sku_vendor', [
        'dataProvider' => $dataProvider,
        'model' => $vendor_model,
        'sku_id'=> $sku_id

    ]) ?>

    <?= $this->render('audit', [
        'dataProvider' => $dataProvider,
        'model' => $vendor_model,
        'sku_id'=> $sku_id

    ]) ?>


</div>
