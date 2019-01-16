<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\MangerAuditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '经理评审');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

    <h6><?= Html::encode($this->title) ?></h6>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'striped'=>true,
        'responsive'=>true,
        'hover'=>true,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> '操作',
                'template' => ' {view}',
                'headerOptions' => ['width' => '100'],

            ],

            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model['pd_pic_url']. "' width='100' height='100'>";


                }
            ],
            'purchaser',
            [
                'attribute'=>'pur_group',
                'value' => function($model) {
                    return $model['pur_group'];
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '一部', '2' => '二部','3' => '三部','4' => '四部','5' => '五部','6' => '六部','7' => '七部','8' => '八部',],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'部门'],
            ],

            [
                'attribute'=>'pd_title',
                'value' => function($model) { return $model['pd_title'];},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'pd_title_en',
                'value' => function($model) { return $model['pd_title_en'];},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'audit_a',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model['audit_a']==1){
                        return '是';

                    }else{
                        return '否';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'是否提交'],
            ],
            [
                'attribute'=>'audit_b',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model['audit_b']==1){
                        return '是';

                    }else{
                        return '否';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'是否提交'],
            ],
            [
                'attribute'=>'master_result',
                'value' => function($model) {
                    if($model['master_result']==0){
                        return '拒绝';
                    }elseif($model['master_result']==1){
                        return '采样';

                    }elseif($model['master_result']==2){
                        return '需议价和谈其他条件';

                    }elseif($model['master_result']==3){
                        return '尚未评';

                    }elseif($model['master_result']==4){
                        return '直接下单';

                    }elseif($model['master_result']==5){
                        return '季节产品推迟';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '拒绝', '1' => '采样', '2' => '需议价和谈其他条件', '3' => '尚未评', '4' => '直接下单', '5' => '季节产品推迟'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审结果'],
            ],
            [
                'attribute'=>'master_mark',
                'value' => function($model) { return $model['master_mark'];},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
            ],
            [
                'attribute'=>'preview_status',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model['preview_status']==1){
                        return '已评审';

                    }else{
                        return '未评审';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '已评审', '0' => '未评审'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审状态'],
            ],
            [
                'attribute' => 'pd_create_time',
                'headerOptions' => ['width' => '12%'],
                'filter' => DateRangePicker::widget([
                    'name' => 'MangerAuditSearch[pd_create_time]',
                    'value' => Yii::$app->request->get('MangerAuditSearch')['pd_create_time'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d H:i:s',
                            'separator' => '/',
                        ]
                    ]
                ])
            ],
            [
                'attribute'=>'source',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->source=='0'){
                        return '销售推荐';

                    }else{
                        return '自主开发';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '自主开发', '0' => '销售推荐'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'产品来源'],
//                'group'=>true,  // enable grouping
            ],

            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model['amazon_url'])) return "<a href='$model[amazon_url]' target='_blank'>".parse_url($model['amazon_url'])['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model['ebay_url'])) return "<a href='$model[ebay_url]' target='_blank'>".parse_url($model['ebay_url'])['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model['url_1688'])) return "<a href='$model[url_1688]' target='_blank'>".parse_url($model['url_1688'])['host']."</a>";
                }
            ],


            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'profit_rate',
            'gross_profit_amz',
            'profit_rate_amz',
            [
                'attribute'=>'remark',
                'value' => function($model) { return $model['remark'];},
                'contentOptions'=> ['style' => 'width: 80%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
        ],
    ]); ?>


</div>


