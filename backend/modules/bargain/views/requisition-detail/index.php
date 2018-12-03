
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
            'item_name',
            'description',
            'povendor_name',
            'quantity',
            'requisition_name',
            'createdate',
        ],
    ]); ?>
</div>