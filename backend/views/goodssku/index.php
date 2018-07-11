<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsskuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goodsskus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodssku-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Goodssku', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sku_id',
            'sku',
            'declared_value',
            'currency_code',
            'old_sku',
            //'is_quantity_check',
            //'contain_battery',
            //'qty_of_ctn',
            //'ctn_length',
            //'ctn_width',
            //'ctn_height',
            //'ctn_fact_weight',
            //'sale_company',
            //'vendor_code',
            //'origin_code',
            //'min_order_num',
            //'pd_get_days',
            //'pd_costprice_code',
            //'pd_costprice',
            //'bill_name',
            //'bill_unit',
            //'brand',
            //'sku_mark',
            //'pur_info_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
