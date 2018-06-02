<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('app', 'Products');
$this->title = '销售推荐';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <p>
        <?= Html::a(Yii::t('app', '创建产品'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo Html::button('确认提交',['class' => 'btn btn-info' ,'id'=>'is_submit'])?>
        <?php echo Html::button('取消提交',['class' => 'btn btn-primary' ,'id'=>'un_submit'])?>


    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'striped'=>true,
        'responsive'=>true,
        'hover'=>true,
        'export' => false,
        'id'=>'commit_product',
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => ' {view} {update} {delete}',
                    'buttons' => [
                    'push' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pushpin"></span>', $url, [
                            'title' => '提交',
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
            'creator',
            [
                'attribute'=>'product_title',
                'value' => function($model) { return $model->product_title;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',

            ],
            [
                'attribute'=>'product_title_en',
                'value' => function($model) { return $model->product_title_en;},
                'contentOptions'=> ['style' => 'width: 90%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',

            ],
            [
                'attribute'=>'is_submit',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) {
                        if($model->is_submit=='0'){
                            return '否';

                        }else{
                            return '是';
                        }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'是否提交'],
                'group'=>true,  // enable grouping
            ],

            'product_purchase_value',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url1)) return "<a href='$model->ref_url1' target='_blank'>".parse_url($model->ref_url1)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url2))  return "<a href='$model->ref_url2' target='_blank'>".parse_url($model->ref_url2)['host']."</a>";

                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url3))  return "<a href='$model->ref_url3' target='_blank'>".parse_url($model->ref_url3)['host']."</a>";

                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '其他链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url4))  return "<a href='$model->ref_url4' target='_blank'>".parse_url($model->ref_url4)['host'] ."</a>";



                }
            ],
            [
                'attribute' => 'product_add_time',
                'format' => ['date', "php:Y-m-d H:i:s"],
                'headerOptions' => ['width' => '12%'],
                'filter' => DateRangePicker::widget([
                    'name' => 'ProductSearch[product_add_time]',
                    'value' => Yii::$app->request->get('ProductSearch')['product_add_time'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d H:i:s',
                            'separator' => '/',
                        ]
                    ]
                ])
            ],
//            'product_update_time:date',
            [
                'attribute'=>'complete_status',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->complete_status==1){
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
                'filterInputOptions'=>['placeholder'=>'是否完成'],
                'group'=>true,  // enable grouping
            ],

        ],
    ]); ?>
</div>

<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">可供选的采购</h4>',
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
$requestAuditUrl = Url::toRoute('pick-purchaser');
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

// 标记产品状态    0 uncommitted  1 commit
//功能放到 index 批量提交    取消提交

$commit = Url::toRoute(['commit']);
$uncommitted = Url::toRoute(['cancel']);
$is_submit = <<<JS

    //批量提交
    $('#is_submit').on('click',function(){
        var button = $(this);
        button.attr('disabled','disabled');
        var ids =  $('#commit_product').yiiGridView("getSelectedRows");
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
    $('#un_submit').on('click',function(){
        var button = $(this);
        button.attr('disabled','disabled');
        var ids =  $('#commit_product').yiiGridView("getSelectedRows");
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
<?php
//已经提交的产品 不能编辑
$un_update = <<<JS
 $('.glyphicon-pencil').on('click',function(){
     
        
 });
JS;



?>
