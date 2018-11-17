<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/4
 * Time: 10:46
 */


use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SkuVendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="sku-vendor-index">

    <legend class="text-info"><h3>5.供应商信息</h3></legend>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'responsive'=>true,
        'export'=>false,
        'panel'=>['type'=>'primary', 'heading'=>'供应商列表'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vendor_code',
            'origin_code',
            'min_order_num',
            'pd_get_days',
            'pd_costprice_code',
            'pd_costprice',
            'bill_name',
            'bill_unit',
            'brand',
            'create_date',
            'update_date',
            'remark',

        ],
    ]); ?>


</div>






