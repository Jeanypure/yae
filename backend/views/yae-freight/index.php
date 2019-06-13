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
            'company_suffix',
            'forwarders',
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
            'group_name',
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
