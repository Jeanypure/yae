<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FinancialAgreestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '财务付款');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'财务付款列表'],
        'id' => 'sample_submit2',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\CheckboxColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {return} ',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                            'title' => '付款',
                            'data-toggle' => 'modal',
                            'data-target' => '#pay-modal',
                            'class' => 'data-pay',
                            'data-id' => $key,
                        ] );
                    },
                    'return' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-backward"></span>', $url, [
                            'title' => '确定退款',
                            'data-toggle' => 'modal',
                            'data-target' => '#return-modal',
                            'class' => 'data-return',
                            'data-id' => $key,
                        ] );
                    },
                ],
            ],

            [
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                }
            ],
            [
                'attribute'=>'purchaser',
                'value' => function($model) { return $model->purchaser;},
                'format'=>'html',
                'label' => '申请人'
,
            ],
            [
                'attribute'=>'pur_group',
                'value' => function($model) {
                    if($model->pur_group==1){
                        return '一部';
                    }elseif ($model->pur_group==2){
                        return '二部';
                    }elseif ($model->pur_group==3){
                        return '三部';
                    }elseif ($model->pur_group==4){
                        return '四部';
                    }elseif ($model->pur_group==5){
                        return '五部';
                    }elseif ($model->pur_group==6){
                        return '六部';
                    }elseif ($model->pur_group==7){
                        return '七部';
                    }elseif ($model->pur_group==8){
                        return '八部';
                    }
                },
                'contentOptions'=> ['style' => 'width: 10%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '一部', '2' => '二部','3' => '三部','4' => '四部','5' => '五部','6' => '六部','7' => '七部','8' => '八部',],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'部门'],
                'group'=>true,  // enable grouping

            ],
            [
                'attribute'=>'pd_sku',
                'value' => function($model) { return $model->pd_sku;},
                'label'=>'SKU',
            ],
            [
                'attribute'=>'pd_title',
                'value' => function($model) { return $model->pd_title;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'pd_title_en',
                'value' => function($model) { return $model->pd_title_en;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            'payer',
            [
                'attribute'=>'has_pay',
                'pageSummary'=>'Page Summary',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->has_pay==1){
                        return '已付';

                    }else{
                        return '未付';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '已付', '0' => '未付'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'是否付款'],
            ],
            [
                'class'=>'kartik\grid\FormulaColumn',
                'attribute'=>'pay_amount',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 3],
                'pageSummary'=>true
            ],
            [
                    'attribute' => 'submit2_at',
                    'headerOptions' => ['width' => '12%'],
                    'filter' => DateRangePicker::widget([
                    'name' => 'FinancialAgreestSearch[submit2_at]',
                    'value' => Yii::$app->request->get('FinancialAgreestSearch')['submit2_at'],
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
                'attribute' => 'pay_at',
                'headerOptions' => ['width' => '12%'],
                'filter' => DateRangePicker::widget([
                    'name' => 'FinancialAgreestSearch[pay_at]',
                    'value' => Yii::$app->request->get('FinancialAgreestSearch')['pay_at'],
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
                'attribute'=>'sample_return',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->sample_return==1){
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
                'filterInputOptions'=>['placeholder'=>'确定退样品?'],
            ],
            [
                'attribute'=>'master_result',
                'value' => function($model) {
                    if($model->master_result==0){
                        return '拒绝';
                    }elseif($model->master_result==1){
                        return '采样';

                    }elseif($model->master_result==2){
                        return '需议价和谈其他条件';

                    }elseif($model->master_result==3){
                        return '尚未评';

                    }elseif($model->master_result==4){
                        return '直接下单';

                    }elseif($model->master_result==5){
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
                'filterInputOptions'=>['placeholder'=>'评审状态'],
            ],
            [
                'attribute'=>'master_mark',
                'value' => function($model) { return $model->master_mark;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],


        ],
    ]); ?>


</div>


<?php
use yii\bootstrap\Modal;
// 付款操作
Modal::begin([
    'id' => 'pay-modal',
    'header' => '<h4 class="modal-title">财务付款</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
    'options'=>[
        'data-backdrop'=>'static',//点击空白处不关闭弹窗
        'data-keyboard'=>false,
    ],
    'size'=> Modal::SIZE_LARGE
]);
Modal::end();
// 退款操作
Modal::begin([
    'id' => 'return-modal',
    'header' => '<h4 class="modal-title">样品费退款到账</h4>',
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
$requestAuditUrl = Url::toRoute('view');  //样品付款
$fee_return = Url::toRoute('fee-back');  //样品退款
$auditJs = <<<JS
        $('.data-pay').on('click', function () {
            $.get('{$requestAuditUrl}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    $('.modal-body').html(data);
                }  
            );
        }); 

        $('.data-return').on('click', function () {
            $.get('{$fee_return}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    $('.modal-body').html(data);
                }  
            );
        });
JS;
$this->registerJs($auditJs);

?>
