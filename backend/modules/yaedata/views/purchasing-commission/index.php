<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/7
 * Time: 13:20
 */
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

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
        [
            'attribute'=>'pur_group',
            'label'=>'部门',
            'value'=>function ($model, $key, $index, $widget) {
                if($model->pur_group==1){
                    return '一部';
                }elseif($model->pur_group==2){
                    return '二部';
                }elseif($model->pur_group==3){
                    return '三部';
                }elseif($model->pur_group==4){
                    return '四部';
                }elseif($model->pur_group==5){
                    return '五部';
                }elseif($model->pur_group==6){
                    return '六部';
                }elseif($model->pur_group==7){
                    return '七部';
                }elseif($model->pur_group==8){
                    return '八部';
                }else{
                    return '9部';
                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(\backend\models\Company::find()->orderBy('sub_company')->asArray()->all(), 'id', 'department_suffix'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'部门']
        ],
        [
            'attribute'=>'purchaser',
            'label'=>'开发员',
        ],
        [
            'attribute'=>'is_purchase',
            'label'=>'是否采购',
            'value' => function($model) {
                if($model->is_purchase==1){
                    return '是';
                }else{
                    return '否';

                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>[0=>'否',1=>'是'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'采购?']
        ],
        [
            'attribute'=>'pd_pur_costprice',
            'label'=>'含税价格(￥)',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
        ],
        [
            'attribute'=>'has_arrival',
            'label'=>'是否到货',
            'value' => function($model) {
                if($model->has_arrival==1){
                    return '是';
                }else{
                    return '否';

                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>[0=>'否',1=>'是'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'到货?']
        ],
        [
            'attribute'=>'write_date',
            'label'=>'到货日期',
            'filter' => DateRangePicker::widget([
                'name' => 'CommissionSearch[write_date]',
                'value' => Yii::$app->request->get('CommissionSearch')['write_date'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'locale' => [
                        'format' => 'Y-m-d',
                        'separator' => '/',
                    ]
                ]
            ])
        ],
        [
            'attribute'=>'minister_result',
            'label'=>'产品等级',
            'value' => function($model) {
                if($model->minister_result==0){
                    return '简单重复';
                }elseif($model->minister_result==1){
                    return '半价产品';

                }elseif($model->minister_result==2){
                    return '新品';

                }elseif($model->minister_result==3){
                    return '推送产品';

                }elseif($model->minister_result==4){
                    return '未判断';

                }else{
                    return '其他';

                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>[0=>'简单重复',1=>'半价产品',2=>'新品',3=>'推送产品',4=>'未判断'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'产品等级']
        ],
        [
            'attribute'=>'unit_price',
            'label'=>'单价提成',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
        ],
        [
            'attribute'=>'weight',
            'label'=>'权重',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'个数',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                return  $widget->col(9, $p) /10;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 1],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'grade',
            'label'=>'采购等级',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 1],

        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'采购新品提成',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                return $widget->col(8, $p) * $widget->col(9, $p) * $widget->col(11, $p)/10;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
    ],
]);
