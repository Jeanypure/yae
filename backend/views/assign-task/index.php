<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '分配评审任务');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

    <p>
        <?= Html::button('选择', ['id' => 'assign-task', 'class' => 'btn btn-success']) ?>
        <?= Html::a('<button class="btn btn-info">分配</button>', '#', [
            'title' => '评审任务分配',
            'data-toggle' => 'modal',
            'data-target' => '#audit-modal',
            'class' => 'data-audit',
        ] );
        ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'id'=>'task',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],

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
                    return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                }
            ],

            'pur_group',
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
                'attribute'=>'is_assign',
                'value' => function($model) {
                    if($model->is_assign==1){
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
                'filterInputOptions'=>['placeholder'=>'是否分配'],
                'group'=>true,  // enable grouping

            ],
            'member',
            [
                'attribute' => 'pd_create_time',
                'headerOptions' => ['width' => '12%'],
                'filter' => DateRangePicker::widget([
                    'name' => 'AssignTaskSearch[pd_create_time]',
                    'value' => Yii::$app->request->get('AssignTaskSearch')['pd_create_time'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d H:i:s',
                            'separator' => '/',
                        ]
                    ]
                ])
            ],

//            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            'is_huge',
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
//            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
            'bill_type',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            'no_rebate_amount',
            'retail_price',
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
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->url_1688)) return "<a href='$model->url_1688' target='_blank'>".parse_url($model->url_1688)['host']."</a>";
                }
            ],

            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
//            'remark',
//            'parent_product_id',

        ],
    ]); ?>
</div>
<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">任务分配</h4>',
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
$requestAuditUrl = Url::toRoute('pick-member');
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
$task = Url::toRoute(['task']);
$js =<<<JS
  $('#assign-task').on('click',function(){
            var button = $(this);
            button.attr('disabled','disabled');
            var ids = $("#task").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) alert('当前你没选择任务---请选择！');
            $.ajax({
                url:'{$task}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    alert(res);     
                   button.attr('disabled',false);
                
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
            });
    });

   
JS;

$this->registerJs($js);


?>
