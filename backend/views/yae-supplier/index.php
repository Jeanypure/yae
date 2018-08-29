<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\YaeSupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商列表';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="yae-supplier-index">
    <p>
        <?= Html::a('创建供应商', ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo Html::button('确认提交',['class' => 'btn btn-info' ,'id'=>'is_submit'])?>
        <?php echo Html::button('取消提交',['class' => 'btn btn-primary' ,'id'=>'un_submit'])?>

    </p>
        <?php  Pjax::begin(['id' => 'vendors'])?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'commit_vendor',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => ' {view} {update} {delete}',
               /* 'buttons' => [
                    'add' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                            'title' => '添加联系人',
                            'data-toggle' => 'modal',
                            'data-target' => '#add-modal',
                            'class' => 'data-contact',
                            'data-id' => $key,
                        ] );
                    },
                ],*/
            ],

            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->business_licence. "' width='100' height='100'>";


                }
            ],

            'supplier_code',
            'supplier_name',
            'supplier_address',
            [
                'attribute'=>'is_submit_vendor',
                'value' => function($model) {
                    if($model->is_submit_vendor==1){
                        return '已提交';
                    }else{
                        return '未提交';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'提交?'],

            ],
            'create_date',
            'submitter',
            'checker',
            [
                'attribute'=>'check_status',
                'value' => function($model) {
                    if($model->check_status==1){
                        return '通过';
                    }elseif ($model->check_status==2){
                        return '半通过';
                    }elseif ($model->check_status==0){
                        return '不通过';
                    }else{
                        return '未处理';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '不通过','1' => '通过','2' => '半通过','3' => '未处理',],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'审核状态'],

            ],

            [
                'attribute'=>'check_memo',
                'value' => function($model) { return $model->check_memo;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],

            [
                'attribute'=>'bill_type',
                'value' => function($model) {
                    if($model->bill_type==0){
                        return '16%专票';
                    }elseif ($model->bill_type==1){
                        return '3%专票';
                    }elseif ($model->bill_type==2){
                        return '增值税普通发票';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '16%专票','1' => '3%专票','2' => '增值税普通发票', ],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'开票类型'],

            ],

            'pay_card',
            'pay_name',
            'pay_bank',
            [
                'attribute'=>'pay_cycleTime_type',
                'value' => function($model) {
                    if($model->pay_cycleTime_type==1){
                        return '日结';
                    }elseif ($model->pay_cycleTime_type==2){
                        return '周结';
                    }elseif ($model->pay_cycleTime_type==3){
                        return '半月结';
                    }elseif ($model->pay_cycleTime_type==4){
                        return '月结';
                    }elseif ($model->pay_cycleTime_type==5){
                        return '隔月结';
                    }elseif ($model->pay_cycleTime_type==6){
                        return '其他';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '日结', '2' => '周结','3' => '半月结','4' => '月结','5' => '隔月结','0' => '其他'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'类型'],

            ],
            [
                'attribute'=>'account_type',
                'value' => function($model) {
                    if($model->account_type==1){
                        return '货到付款';
                    }elseif ($model->account_type==2){
                        return '款到发货';
                    }elseif ($model->account_type==3){
                        return '周期结算';
                    }elseif ($model->account_type==4){
                        return '售后付款';
                    }elseif ($model->account_type==5){
                        return '默认方式';
                    }elseif ($model->account_type==6){
                        return '其他';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '日结', '2' => '周结','3' => '半月结','4' => '月结','5' => '隔月结','0' => '其他'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'方式'],

            ],
            'account_proportion',
            [
                'attribute'=>'has_cooperate',
                'value' => function($model) {
                    if($model->has_cooperate==1){
                        return '是';
                    }elseif($model->has_cooperate==0){
                        return '否';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'合作过?'],

            ],
            'complete_num',
            [
                'attribute'=>'licence_pass',
                'value' => function($model) {
                    if($model->licence_pass==1){
                        return '是';
                    }elseif($model->licence_pass==0){
                        return '否';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'通过?'],

            ],
            [
                'attribute'=>'bill_pass',
                'value' => function($model) {
                    if($model->bill_pass==1){
                        return '是';
                    }elseif($model->bill_pass==0){
                        return '否';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'通过?'],

            ],
            [
                'attribute'=>'bank_data_pass',
                'value' => function($model) {
                    if($model->bank_data_pass==1){
                        return '是';
                    }elseif($model->bank_data_pass==0){
                        return '否';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'通过?'],

            ],

//            'licence_pass',
//            'bill_pass',
//            'bank_data_pass',
            'sup_remark',
        ],
    ]); ?>

        <?php  Pjax::end()?>

    </div>


<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'add-modal',
    'header' => '<h4 class="modal-title">添加联系人</h4>',
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
$requestAuditUrl = Url::toRoute('add-contact');
$auditJs = <<<JS
        $('.data-contact').on('click', function () {
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

$del_h3 = <<<JS
    $(function() {
        $('h3').remove();
      
    })
JS;

$this->registerJs($del_h3);


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
        var ids =  $('#commit_vendor').yiiGridView("getSelectedRows");
        console.log(ids);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$commit}", 
         type: 'post',
         data:{id:ids},
         success:function(res){
           // if(res=='success') alert('提交产品成功!');     
           button.attr('disabled',false);
              $.pjax.reload({container:"#vendors"});  //Reload GridView
           // location.reload();
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
        var ids =  $('#commit_vendor').yiiGridView("getSelectedRows");
        console.log(ids);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$uncommitted}", 
         type: 'post',
         data:{id:ids},
         success:function(res){
           // if(res=='success') alert('取消提交成功!');
           button.attr('disabled',false);
           $.pjax.reload({container:"#vendors"});  //Reload GridView

           // location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
         }
      
    });
});
JS;

$this->registerJs($is_submit);




?>
