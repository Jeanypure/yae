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
        <?php echo Html::button('提交申请',['class' => 'btn btn-info' ,'id'=>'sample-submit'])?>
        <?php echo Html::button('取消提交',['class' => 'btn btn-primary' ,'id'=>'sample-un-submit'])?>
    </p>
    <div class="pur-info-index">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'sample_submit1',
            'export' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn'],
                ['class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{view} ',
                ],

//            'pur_info_id',
//                'spur_info_id',
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


            ],
        ]); ?>
    </div>


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
           if(res=='success') console.log('提交产品成功!');     
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