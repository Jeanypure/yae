
<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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
            ], [
                'attribute'=>'commit_status',
                'value' => function($model) { if($model->commit_status==1){return '是';}else{ return '否';} },
                'contentOptions'=> ['style' => 'width:5%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'提交状态'],
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