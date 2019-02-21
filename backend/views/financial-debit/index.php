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

            'fina_res',
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
                        return '上海鹏侯贸易有限公司';
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
                'filter'=>[ '1' => '商舟', '2' => '雅耶', '3' => '朗探', '4' => '域聪', '5' => '鹏侯', '6' => '客尊'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'付款人'],
            ],
            [
                'attribute'=>'receiver',
                'value' => function($model) {
                    $company = [ '1' => '大森林', '2' => '珑瑗', '3' => '昊宏', '4' => '安泰克', '5' => '文鼎','6'=>'龙辕',
                        '7'=>'瀚明','8'=>'德威','9'=>'世纪卓越'];
                    return $company[$model->receiver];
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>[ '1' => '大森林', '2' => '珑瑗', '3' => '昊宏', '4' => '安泰克', '5' => '文鼎','6'=>'龙辕','7'=>'瀚明',
                    '8'=>'德威','9'=>'世纪卓越'],
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
                'attribute'=>'group_id',
                'value' => function($model) {
                    $group = [0 => '无',
                        1 => '商舟美国销售组-A1',
                        2 => '商舟加拿大销售组-A2',
                        3 => '商舟澳洲销售组-A5',
                        4 => '商舟日本销售组-A6',
                        5 => '商舟朵邦销售组-A7',
                        6 => '雅耶美国销售组-B1',
                        7 => '雅耶加拿大销售组-B2',
                        8 => '雅耶欧洲销售组-B4',
                        9 => '雅耶澳洲销售组-B5',
                        10 => '朗探美国销售组-C1',
                        11 => '朗探加拿大销售组-C2',
                        12 => '域聪美国销售组-D1',
                        13 => '鹏侯美国销售组-E1',
                        14 => '客尊美国销售组-F1',
                        15 => '客尊加拿大销售组-F2',
                        16 => '朵邦美国销售组-G1',
                    ];
                    return $group[$model->group_id];
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>$paramData['group_name'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'销售组别'],
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

            'mini_res',
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

