<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/7
 * Time: 17:00
 */
use kartik\grid\GridView;

echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'showPageSummary'=>true,
    'pjax'=>true,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'primary', 'heading'=>'采购提成列表'],
    'columns'=>[
        ['class'=>'kartik\grid\SerialColumn'],
        /* [
             'attribute'=>'pd_pic_url',
             'width'=>'10px',
             'hAlign'=>'right',
             'format'=>[ 'image'],

         ],*/

        /*[
            'attribute'=>'supplier_id',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->supplier->company_name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Suppliers::find()->orderBy('company_name')->asArray()->all(), 'id', 'company_name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any supplier'],
            'group'=>true,  // enable grouping
        ],
        [
            'attribute'=>'category_id',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->category->category_name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Categories::find()->orderBy('category_name')->asArray()->all(), 'id', 'category_name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any category']
        ],*/

        [
            'attribute'=>'pur_info_id',
            'label'=>'ID',
        ], [
            'attribute'=>'purchaser',
            'label'=>'采购',
        ],
        [
            'attribute'=>'is_purchase',
            'label'=>'确定采购',
        ],
        [
            'attribute'=>'pd_pur_costprice',
            'label'=>'含税价格(￥)',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
//            'pageSummary'=>true
        ],
        [
            'attribute'=>'has_arrival',
            'label'=>'是否到货',
        ],
        [
            'attribute'=>'write_date',
            'label'=>'到货日期',
        ],
        [
            'attribute'=>'minister_result',
            'label'=>'部长判断',
        ],
        [
            'attribute'=>'unit_price',
            'label'=>'单价提成',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
//            'pageSummary'=>true
        ],
        [
            'attribute'=>'weight',
            'label'=>'个数',
        ],
/*
         [
             'attribute'=>'unit_price',
             'width'=>'150px',
             'hAlign'=>'right',
             'format'=>['decimal', 2],
             'pageSummary'=>true,
             'pageSummaryFunc'=>GridView::F_AVG
         ],*/
        [
            'attribute'=>'grade',
            'label'=>'等级',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 1],

        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'新品提成1',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                return $widget->col(8, $p) * $widget->col(9, $p) * $widget->col(10, $p)/10;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
    ],
]);