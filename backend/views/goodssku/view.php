<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */

$this->title = $model->sku_id;
$this->params['breadcrumbs'][] = ['label' => 'Goodsskus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodssku-view">

    <p>
        <img src="<?php echo $model->image_url ?>" alt="" height="100" width="100">
    </p>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sku_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sku_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sku_id',
            'sku',
            'declared_value',
            'currency_code',
            'old_sku',
            'is_quantity_check',
            'contain_battery',
            'qty_of_ctn',
            'ctn_length',
            'ctn_width',
            'ctn_height',
            'ctn_fact_weight',
            'sale_company',
            'vendor_code',
            'origin_code',
            'min_order_num',
            'pd_get_days',
            'pd_costprice_code',
            'pd_costprice',
            'bill_name',
            'bill_unit',
            'brand',
            'sku_mark',
            'pur_info_id',
        ],
    ]) ?>

</div>
