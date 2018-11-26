<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\bargain\models\RequisitionDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '审核同步请购产品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-detail-index">

    <p>
        <?= Html::a('Create Requisition Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' =>'操作',
                'template' => '{update}'
            ],
            'item_name',
            'description',
            'povendor_name',
            'quantity',
            'createdate',
            //'item_name',
            //'povendor_internalid',
            //'povendor_name',
            //'quantity',
            //'rate',
            //'createdate',
            //'lastmodifieddate',
            //'trandate',
            //'currencyname',
            //'supplier_name',
            //'contact_name',
            //'contact_tel',
            //'contact_qq',
            //'bill_type',
            //'arrival_date',
            //'payment_method',
            //'negotiant',
            //'commit_time',
            //'commit_status',
            //'audit_time',
            //'audit_status',
            //'last_price_min',
            //'after_bargain_price',
        ],
    ]); ?>
</div>
