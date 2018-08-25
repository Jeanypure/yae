<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuditSupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商列表-审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-supplier-index">
    <p>
        <?php echo Html::button('导出易仓excel',['class' => 'btn btn-info' ,'id'=>'export-eccang'])?>
        <?php
//        echo Html::button('标记已导易仓',['class' => 'btn btn-info' ,'id'=>'is_submit'])?>
        <?php
//        echo Html::button('取消标记',['class' => 'btn btn-primary' ,'id'=>'un_submit'])?>
        <?php echo Html::button('导入NetSuite',['class' => 'btn btn-warning' ,'id'=>'export-netsuite'])?>


    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'audit_supplier',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => ' {update}'
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
            'create_date',
            'into_eccang_date',
            'check_date',
            'pd_bill_name',
            'bill_unit',
            'submitter',
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

//            'business_licence',
//            'bank_account_data',
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
                    }elseif ($model->pay_cycleTime_type==0){
                        return '其他';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '日结', '2' => '周结','3' => '半月结','4' => '月结','5' => '隔月结','6' => '其它'],
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
                        return '其它';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '货到付款', '2' => '款到发货','3' => '周期结算','4' => '售后付款','5' => '默认方式','6' => '其它'],
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

//            'bill_img1',
//            'bill_img1_name_unit',
//            'bill_img2',
//            'bill_img2_name_unit',
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
    <?php Pjax::end(); ?>
</div>
<?php
  $export = Url::toRoute(['export']);
  $export_eccang =<<<JS
        $(function() {
          $('#export-eccang').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                var ids =  $('#audit_supplier').yiiGridView("getSelectedRows");
                var id = ids[0];

                if(ids==false) alert('请选择产品!') ;
                $.ajax({
                 url: "{$export}", 
                 type: 'get',
                 data:{id:id},
                 success:function(res){
                   button.attr('disabled',false);
                   window.location.href = '{$export}'+'?id='+id;
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                  });
             });
        });
JS;

  $this->registerJs($export_eccang);

?>