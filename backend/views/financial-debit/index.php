<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FinancialDebitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '财务费用检查';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-index">
    <?php echo Html::button('导出选中项',['class' => 'btn btn-warning' ,'id'=>'export-freight-fee'])?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'财务付款列表'],
        'id' => 'debit',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\CheckboxColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'header' => '操作',
                'template' => '{audit}',
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
            ],
            [
                'attribute'=>'bill_to',
                'value' => function($model) {
                    if($model->bill_to ==1 ){
                        return '上海商舟船舶用品有限公司';
                    }elseif($model->bill_to ==2 ){
                        return '上海雅耶贸易有限公司';
                    }elseif($model->bill_to ==3 ){
                        return '上海朗探贸易有限公司';
                    }elseif($model->bill_to ==4 ){
                        return '上海域聪贸易有限公司';
                    }elseif($model->bill_to ==5 ){
                        return '上海朋侯贸易有限公司';
                    }elseif($model->bill_to ==6 ){
                        return '上海客尊贸易有限公司';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>[ '1' => '商舟', '2' => '雅耶', '3' => '朗探', '4' => '域聪', '5' => '朋侯', '6' => '客尊'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'付款人'],
            ],
            [
                'attribute'=>'receiver',
                'value' => function($model) {
                    if($model->receiver ==1 ){
                        return ' 深圳大森林国际货代有限公司';
                    }elseif($model->receiver ==2 ){
                        return '上海珑瑗国际货物运输代理有限公司';
                    }elseif($model->receiver ==3 ){
                        return '上海昊宏国际货物运输代理有限公司';
                    }elseif($model->receiver ==4 ){
                        return '深圳市安泰克物流有限公司';
                    }elseif($model->receiver ==5 ){
                        return '文鼎供应链管理(上海)有限公司';
                    }

                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>[ '1' => '大森林', '2' => '珑瑗', '3' => '昊宏', '4' => '安泰克', '5' => '文鼎'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'货代公司'],
            ],
            'contract_no',
            'debit_no',
            'shipment_id',
            'pod',
            'pol',
            'etd',
            'eta',
            [
                'attribute'=>'remark',
                'value' => function($model) { return $model->remark;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'to_financial',
                'value' => function($model) {
                    if($model->to_financial==1){
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
                'filterInputOptions'=>['placeholder'=>'提交财务?'],

            ],
            [
                'attribute'=>'mini_deal',
                'value' => function($model) {
                    if($model->mini_deal==1){
                        return '已处理';
                    }else{
                        return '未处理';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '未处理', '1' => '已处理'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'部长处理?'],

            ],
            [
                'attribute'=>'fina_deal',
                'value' => function($model) {
                    if($model->fina_deal==1){
                        return '已处理';
                    }else{
                        return '未处理';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '未处理', '1' => '已处理'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'财务处理?'],

            ],
            'mini_res',
            'fina_res',
            'builder',
            'build_at',
            'update_at',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>


<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">费用明细</h4>',
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
$requestAuditUrl = Url::toRoute('update');
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
$export = Url::toRoute(['export']);
$export_debit =<<<JS
        $(function() {
          $('#export-freight-fee').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                var ids =  $('#debit').yiiGridView("getSelectedRows");
                var str_id  = ids.toString();
                    console.log(ids);
                    console.log(str_id);
                if(ids==false) alert('请选择产品!') ;
                $.ajax({
                 url: "{$export}", 
                 type: 'get',
                 data:{id:str_id},
                 success:function(res){
                   button.attr('disabled',false);
                   window.location.href = '{$export}'+'?id='+str_id;
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                  });
             });
        });
JS;

$this->registerJs($export_debit);

?>

