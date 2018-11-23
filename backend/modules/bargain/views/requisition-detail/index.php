
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\bargain\models\RequisitionDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '请购产品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-detail-index">


    <p>
        <?= Html::a('批量提交', ['create'], ['class' => 'btn btn-success']) ?>
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

//            'id',
//            'tran_internal_id',
            'item_name',
            'description',
            'povendor_name',
            'quantity',
            'createdate',
//            'tranid',
//            'amount',
            //'item_internal_id',
            //'linkedorder_internalid',
            //'linkedorder_name',
            //'linkedorderstatus',
            //'povendor_internalid',

            //'rate',
            //'lastmodifieddate',
            //'trandate',
            //'currencyname',

        ],
    ]); ?>
</div>