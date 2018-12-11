<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\YaeFreightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '货单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-index">

        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('提交部长核对', ['id' => 'to_mini', 'class' => 'btn btn-primary']) ;?>
        <?=  Html::button('取消提交', ['id' => 'cancel', 'class' => 'btn btn-info']) ?>
        <?php echo Html::button('导出选中项',['class' => 'btn btn-warning' ,'id'=>'export-freight-fee'])?>


    </p>

    <?php Pjax::begin(['id' => 'debit-list']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'货单列表'],
        'id' => 'debit',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\CheckboxColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'header' => '操作'
            ],
            [
                'attribute'=>'to_minister',
                'value' => function($model) {
                    if($model->to_minister==1){
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
                'filterInputOptions'=>['placeholder'=>'提交?'],
            ],
            [
                'attribute'=>'bill_to',
                'value' => function($model) {
                    if($model->bill_to ==1 ){
                        return '上海商舟船舶用品有限公司';
                    }elseif($model->bill_to ==2 ){
                        return '雅耶国际贸易(上海)有限公司';
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
                /*1 => '深圳大森林国际货代有限公司',
                       2 => '上海珑瑗国际货物运输代理有限公司',
                       3 => '上海昊宏国际货物运输代理有限公司',
                       4 => '深圳市安泰克物流有限公司',
                       5 => '文鼎供应链管理(上海)有限公司',*/
                'value' => function($model) {
                    $company = [ '1' => '大森林', '2' => '珑瑗', '3' => '昊宏', '4' => '安泰克', '5' => '文鼎','6'=>'龙辕'];
                        return $company[$model->receiver];
                    },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>[ '1' => '大森林', '2' => '珑瑗', '3' => '昊宏', '4' => '安泰克', '5' => '文鼎','6'=>'龙辕'],
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
                'attribute'=>'minister',
                'value' => function($model) { return $model->minister;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
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
            [
                'attribute'=>'remark',
                'value' => function($model) { return $model->remark;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>

<?php
 $js = <<<JS
   $(function() {
     $('h3').remove();
   });
JS;
 $this->registerJs($js);
?>

<?php
$submit = Url::toRoute('submit');
$unsubmit = Url::toRoute('cancel');
//提交评审
$is_submit_manager =<<<JS
    $('#to_mini').on('click',function() {
            var button = $(this);
            button.attr('disabled','disabled');
            var ids = $("#debit").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) alert('请选择产品后再操作!');
            $.ajax({
            url:'{$submit}',
            type:'post',
            data:{id:ids},
            success:function(res){
                // if(res=='success') alert('提交成功!');
                //  button.attr('disabled',false);
                // location.reload();
                if(res=='success') {
                     button.attr('disabled',false);
                     $.pjax.reload({container:"#debit-list"});  //Reload GridView
                }
               

            },
            error: function (jqXHR, textStatus, errorThrown) {
                button.attr('disabled',false);
            }
            
            });
      
    });
//取消提交

    $('#cancel').on('click',function() {
                var button = $(this);
                button.attr('disabled','disabled');
                var ids = $("#debit").yiiGridView("getSelectedRows");
                console.log(ids);
                if(ids.length ==0) alert('请选择产品后再操作!');
                $.ajax({
                url:'{$unsubmit}',
                type:'post',
                data:{id:ids},
                success:function(res){
                    // if(res=='success') alert('取消成功!');
                    // button.attr('disabled',false);
                    // location.reload();
                     if(res=='success') {
                     button.attr('disabled',false);
                     $.pjax.reload({container:"#debit-list"});  //Reload GridView
                }
    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
                }
                
                });
          
        });
JS;



$this->registerJs($is_submit_manager);
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
                if(ids==false) alert('请选择!') ;
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
