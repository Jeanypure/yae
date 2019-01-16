<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\MinisterAgreestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '部长审批');
$this->params['breadcrumbs'][] = $this->title;
?>
    <p>
        <?php
//        echo Html::button('同意付样品费',['class' => 'btn btn-info' ,'id'=>'sample-submit'])?>
        <?php
//        echo Html::button('不同意',['class' => 'btn btn-primary' ,'id'=>'sample-un-submit'])?>
    </p>
    <div class="pur-info-index">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'sample_submit1',
            'export' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//                ['class' => 'yii\grid\CheckboxColumn'],
                ['class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{view}  {saved} ',
                    'buttons' => [
                        'saved' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-saved"></span>',
                                $url,
                                [
                                'title' => '质量审核 ',
                                'data-toggle' => 'modal',
                                'data-target' => '#audit-modal',
                                'class' => 'data-audit',
                                'data-id' => $key,
                            ] );
                        },
                        'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-share"></span>', $url, [
                                'title' => '同意付費',
                                'data-toggle' => 'modal',
                                'data-target' => '#agree-modal',
                                'class' => 'data-agree',
                                'data-id' => $key,
                            ] );
                        },
                    ],
                ],
                [
                    'class' => 'yii\grid\Column',
                    'headerOptions' => [
                        'width'=>'100'
                    ],
                    'header' => '图片',
                    'content' => function ($model, $key, $index, $column){
                        return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                    }
                ],

                'purchaser',
                [
                    'attribute'=>'pur_group',
                    'value' => function($model) {
                       return $model->pur_group;
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
                [
                    'attribute'=>'is_agreest',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $widget) {
                        if($model->is_agreest==1){
                            return '同意';

                        }elseif ($model->is_agreest==2){
                            return '未处理';
                        }else{
                            return '不同意';
                        }
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>['1' => '同意', '0' => '不同意', '2' => '未处理'],
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'同意付费?'],
                ],
                [
                    'attribute'=>'sample_submit2',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $widget) {
                        if($model->sample_submit2==1){
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
                'payer',
                [
                    'attribute'=>'has_pay',
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
                    'attribute'=>'is_quality',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $widget) {
                        if($model->is_quality==1){
                            return '合格';

                        }elseif($model->is_quality==0){
                            return '不合格';
                        }else{
                            return '未检测';

                        }
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>['1' => '合格', '0' => '不合格', '2' => '未检测'],
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'质量合格?'],
                ],
                [
                    'attribute'=>'is_purchase',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $widget) {
                        if($model->is_purchase==1){
                            return '采购';

                        }elseif($model->is_purchase==0){
                            return '不采购';
                        }else{
                            return '未决定';

                        }
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>['1' => '采购', '0' => '不采购', '2' => '未决定'],
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'确定采购?'],
                ],
                [
                    'attribute'=>'has_arrival',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $widget) {
                        if($model->has_arrival==1){
                            return '已到货';

                        }else{
                            return '未到货';

                        }
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>['1' => '已到货', '0' => '未到货'],
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'是否到货'],
                ],

                [
                    'attribute'=>'minister_result',
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

                        }
                    },
                    'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                    'format'=>'html',
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>['0' => '未判断', '1' => '半价产品', '2' => '新品', '3' => '推送产品', '4' => '简单重复'],
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'产品等级'],
                ],
                [
                    'attribute' => 'write_date',
                    'headerOptions' => ['width' => '12%'],
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
                [
                    'attribute' => 'submit1_at',
                    'headerOptions' => ['width' => '12%'],
                    'filter' => DateRangePicker::widget([
                        'name' => 'MinisterAgreestSearch[submit1_at]',
                        'value' => Yii::$app->request->get('MinisterAgreestSearch')['submit1_at'],
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
                    'attribute' => 'submit2_at',
                    'headerOptions' => ['width' => '12%'],
                    'filter' => DateRangePicker::widget([
                        'name' => 'MinisterAgreestSearch[submit2_at]',
                        'value' => Yii::$app->request->get('MinisterAgreestSearch')['submit2_at'],
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'locale' => [
                                'format' => 'Y-m-d H:i:s',
                                'separator' => '/',
                            ]
                        ]
                    ])
                ],



            ],
        ]); ?>
    </div>

<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">标记样品是否合格</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
    'options'=>[
        'data-backdrop'=>'static',//点击空白处不关闭弹窗
        'data-keyboard'=>false,
    ],
    'size'=> Modal::SIZE_LARGE
]);
Modal::end();

//费用
Modal::begin([
    'id' => 'agree-modal',
    'header' => '<h4 class="modal-title">样品费用信息</h4>',
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
$requestAuditUrl = Url::toRoute('quality');
$auditJs = <<<JS
        $('.data-audit').on('click', function () {
            $.get('{$requestAuditUrl}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    $('.modal-body').html(data);
                }  
            );
        });
JS;
$this->registerJs($auditJs);



$share_url = Url::toRoute('view');
$share_js = <<<JS
        $('.data-agree').on('click', function () {
            $.get('{$share_url}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    $('.modal-body').html(data);
                }
            );
        });
JS;
$this->registerJs($share_js);




?>


<?php
// 1采购到部长  2部长到财务 sample_submit1  sample_submit2
// 提交申请    取消提交

$commit = Url::toRoute(['commit']);
$uncommitted = Url::toRoute(['cancel']);
$is_submit = <<<JS

    //批量提交
    $('#sample-submit').on('click',function(){
         var button = $(this);
         button.attr('disabled','disabled');
        var ids =  $('#sample_submit1').yiiGridView("getSelectedRows");
        console.log(ids);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$commit}", 
         type: 'post',
         data:{id:ids},
         success:function(res){
           if(res=='success') alert('提交产品成功!');     
           button.attr('disabled',false);
           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
         }
      
    });
});

//取消提交
    $('#sample-un-submit').on('click',function(){
        var button = $(this);
         button.attr('disabled','disabled');
        var ids =  $('#sample_submit1').yiiGridView("getSelectedRows");
        console.log(ids);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$uncommitted}", 
         type: 'post',
         data:{id:ids},
         success:function(res){
           if(res=='success') alert('取消提交成功!');
           button.attr('disabled',false);
           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
         }
      
    });
});
JS;
$this->registerJs($is_submit);
?>