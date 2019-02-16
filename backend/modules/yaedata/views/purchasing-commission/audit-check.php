<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/9
 * Time: 17:40
 */

use yii\helpers\Html;
use yii\helpers\Url;
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
    'panel'=>['type'=>'primary', 'heading'=>'采购产品提成列表--产品等级调整'],
    'columns'=>[
        ['class'=>'kartik\grid\SerialColumn'],
        [
            'class'=>'kartik\grid\ActionColumn',
            'template' => ' {adjust} ',
            'buttons' => [
                'adjust' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-adjust"></span>', $url, [
                        'title' => '产品等级调整',
                        'data-toggle' => 'modal',
                        'data-target' => '#adjust-modal',
                        'class' => 'data-adjust',
                        'data-id' => $key,
                    ] );
                },
            ],

        ],
        [
            'attribute'=>'pd_pic_url',
            'label'=>'图片',
            'value' => function($model) {
                return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";
            },
            'format'=>['raw'],

        ],
        [
            'attribute'=>'pd_sku',
            'label'=>'SKU',
            'width'=>'100px',
            'hAlign'=>'center',
        ],

        [
            'attribute'=>'pd_title',
            'label'=>'中文名',
            'width'=>'100px',
            'hAlign'=>'center',
        ],
        [
            'attribute'=>'pur_group',
            'label'=>'部门',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->pur_group;
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
            'format'=>['decimal', 3],
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
            'attribute'=>'is_diff',
            'label'=>'不一致?',
            'value' => function($model) {
                if($model->is_diff==1){
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
            'filterInputOptions'=>['placeholder'=>'不一致?']
        ],
        [
            'attribute'=>'minister_result',
            'label'=>'部长判断',
            'value' => function($model) {
                if($model->minister_result==0){
                    return '未判断';
                }elseif($model->minister_result==1){
                    return '半价产品';
                }elseif($model->minister_result==2){
                    return '新品';
                }elseif($model->minister_result==3){
                    return '推送产品';
                }elseif($model->minister_result==4){
                    return '简单重复';
                }elseif($model->minister_result==5){
                    return '不算提成';
                }elseif($model->minister_result==6){
                    return '推送且半价';
                }else{
                    return '其他';

                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>[0=>'未判断',1=>'半价产品',2=>'新品',3=>'推送产品',4=>'简单重复',5=>'不算提成',6=>'推送且半价'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'产品等级']
        ],
        [
            'attribute'=>'purchaser_result',
            'label'=>'采购判断',
            'value' => function($model) {
                if($model->purchaser_result==0){
                    return '未判断';
                }elseif($model->purchaser_result==1){
                    return '半价产品';
                }elseif($model->purchaser_result==2){
                    return '新品';
                }elseif($model->purchaser_result==3){
                    return '推送产品';
                }elseif($model->purchaser_result==4){
                    return '简单重复';
                }elseif($model->purchaser_result==5){
                    return '不算提成';
                }elseif($model->purchaser_result==6){
                    return '推送且半价';
                }else{
                    return '其他';

                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>[0=>'未判断',1=>'半价产品',2=>'新品',3=>'推送产品',4=>'简单重复',5=>'不算提成',6=>'推送且半价'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'产品等级']
        ],
        [
            'attribute'=>'audit_team_result',
            'label'=>'审核组判断',
            'value' => function($model) {
                if($model->purchaser_result==0){
                    return '未判断';
                }elseif($model->purchaser_result==1){
                    return '半价产品';
                }elseif($model->purchaser_result==2){
                    return '新品';
                }elseif($model->purchaser_result==3){
                    return '推送产品';
                }elseif($model->purchaser_result==4){
                    return '简单重复';
                }elseif($model->purchaser_result==5){
                    return '不算提成';
                }elseif($model->purchaser_result==6){
                    return '推送且半价';
                }else{
                    return '其他';

                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>[0=>'未判断',1=>'半价产品',2=>'新品',3=>'推送产品',4=>'简单重复',5=>'不算提成',6=>'推送且半价'],
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
                return  $widget->col(16, $p) /100;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
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
                if($model->source == 0){
                    return $widget->col(15, $p) * $widget->col(16, $p)/10;
                }
                return $widget->col(15, $p) * $widget->col(16, $p) * $widget->col(18, $p)/100;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
    ],
]);

?>
<?php
use yii\bootstrap\Modal;

// 产品等级核算
Modal::begin([
    'id' => 'adjust-modal',
    'header' => '<h4 class="modal-title">产品等级调整</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
    'options'=>[
        'data-backdrop'=>'static',//点击空白处不关闭弹窗
        'data-keyboard'=>false,
    ],
    'size'=> Modal::SIZE_LARGE
]);
Modal::end();
?>

<?php
//产品等级核算
$adjust_url = Url::toRoute('adjust');
$adjust_js = <<<JS
     $('.data-adjust').on('click', function () {
            $.get('{$adjust_url}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    $('.modal-body').html(data);
                }
            );
        });
JS;
$this->registerJs($adjust_js);
?>
