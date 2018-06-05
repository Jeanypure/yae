<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '产品评审');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">


    <p>
        <?php
//        echo Html::a(Yii::t('app', '创建新品'), ['create'], ['class' => 'btn btn-success']);
        ?>

    </p>

    <p>
        <?= Html::button('提交评审', ['id' => 'is_submit_manager', 'class' => 'btn btn-primary']) ;?>
        <?=  Html::button('取消提交', ['id' => 'un_submit_manager', 'class' => 'btn btn-info']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'id'=>'audit',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{audit}  {view}',
                'buttons' => [
                    'audit' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                            'title' => '评审',
                            'data-toggle' => 'modal',
                            'data-target' => '#audit-modal',
                            'class' => 'data-audit',
                            'data-id' => $key,
                        ] );
                    },
                ],
                'headerOptions' => ['width' => '80'],
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
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
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
                'contentOptions'=> ['style' => 'width: 50%; overflow:auto;word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'master_result',
                'value' => function($model) {
                    if($model->master_result==0){
                        return '拒绝';
                    }elseif($model->master_result==1){
                        return '采样';

                    }elseif($model->master_result==2){
                        return '可以开发';

                    }elseif($model->master_result==3){
                        return '尚未评';

                    }elseif($model->master_result==4){
                        return '直接下单';

                    }elseif($model->master_result==5){
                        return '季节产品推迟';

                    }elseif($model->master_result==6){
                        return '需议价和谈其他条件';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '拒绝', '1' => '采样', '2' => '可以开发', '3' => '尚未评', '4' => '直接下单', '5' => '季节产品推迟', '6' => '需议价和谈其他条件'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审状态'],
            ],

            [
                'attribute'=>'master_mark',
                'value' => function($model) { return $model->master_mark;},
                'contentOptions'=> ['style' => 'width: 50%; overflow:auto;word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'view_status',
                'value' => function($model) {
                    if($model->view_status==1){
                        return '已评审';
                    }else{
                        return '未评审';

                    }
                    },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '未评审', '1' => '已评审'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审状态'],
//                'group'=>true,  // enable grouping

            ],
            [
                'attribute'=>'submit_manager',
                'value' => function($model) {
                    if($model->submit_manager==1){
                        return '是';
                    }else{
                        return '否';

                    }
                    },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '否', '1' => '是'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审状态'],
//                'group'=>true,  // enable grouping

            ],
            [
                'attribute' => 'pd_create_time',
                'format' => ['date', "php:Y-m-d H:i:s"],
                'headerOptions' => ['width' => '12%'],
                'filter' => DateRangePicker::widget([
                    'name' => 'AuditSearch[pd_create_time]',
                    'value' => Yii::$app->request->get('AuditSearch')['pd_create_time'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d H:i:s',
                            'separator' => '/',
                        ]
                    ]
                ])
            ],

            'pd_length',
            'pd_width',
            'pd_height',
            [
                'attribute'=>'is_huge',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->is_huge==1){
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
                'filterInputOptions'=>['placeholder'=>'是否大件'],
                'group'=>true,  // enable grouping
            ],
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
//            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
            'bill_type',
            'bill_tax_value',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ebay_url)) return "<a href='$model->ebay_url' target='_blank'>".parse_url($model->ebay_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->amazon_url)) return "<a href='$model->amazon_url' target='_blank'>".parse_url($model->amazon_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->url_1688)) return "<a href='$model->url_1688' target='_blank'>".parse_url($model->url_1688)['host']."</a>";
                }
            ],
//            'shipping_fee',
//            'oversea_shipping_fee',
//            'transaction_fee',
            'retail_price',
            'no_rebate_amount',
            'gross_profit',
            'profit_rate',
            'gross_profit_amz',
            'profit_rate_amz',
//            'remark',

        ],
    ]); ?>
</div>

<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">评审产品</h4>',
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
$requestAuditUrl = Url::toRoute('create-audit');
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

?>
<?php
$submit = Url::toRoute('submit');
$unsubmit = Url::toRoute('cancel');
//提交评审
$is_submit_manager =<<<JS
    $('#is_submit_manager').on('click',function() {
            var button = $(this);
            button.attr('disabled','disabled');
            var ids = $("#audit").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) alert('请选择产品后再操作!');
            $.ajax({
            url:'{$submit}',
            type:'post',
            data:{id:ids},
            success:function(res){
                if(res=='success') alert('提交成功!');
                button.attr('disabled',false);
                location.reload();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                button.attr('disabled',false);
            }
            
            });
      
    });
//取消提交

    $('#un_submit_manager').on('click',function() {
                var button = $(this);
                button.attr('disabled','disabled');
                var ids = $("#audit").yiiGridView("getSelectedRows");
                console.log(ids);
                if(ids.length ==0) alert('请选择产品后再操作!');
                $.ajax({
                url:'{$unsubmit}',
                type:'post',
                data:{id:ids},
                success:function(res){
                    if(res=='success') alert('取消成功!');
                    button.attr('disabled',false);
                    location.reload();
    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
                }
                
                });
          
        });
JS;



$this->registerJs($is_submit_manager);
?>