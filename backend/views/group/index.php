<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '销售推荐--分部公示');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">


    <p>
        <?= Html::button('确认公示', ['id' => 'brocast', 'class' => 'btn btn-primary']) ;?>
        <?=  Html::button('公示结束', ['id' => 'end-brocast', 'class' => 'btn btn-info']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'group',
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
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
                'attribute'=>'sub_company',
                'value' => function($model) {
                    if($model->sub_company==1){
                        return '一部';
                    }elseif($model->sub_company==2){
                        return '二部';
                    }elseif($model->sub_company==3){
                        return '三部';
                    }elseif($model->sub_company==4){
                        return '四部';
                    }elseif($model->sub_company==5){
                        return '五部';
                    }elseif($model->sub_company==6){
                        return '六部';
                    }elseif($model->sub_company==7){
                        return '七部';
                    }elseif($model->sub_company==8){
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
                'attribute'=>'product_title',
                'value' => function($model) { return $model->product_title;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
            ],
            [
                'attribute'=>'product_title_en',
                'value' => function($model) { return $model->product_title_en;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
            ],
            [
                'attribute'=>'brocast_status',
                'value' => function($model) {
                        if($model->brocast_status==0){
                            return '未公示';
                        }elseif ($model->brocast_status==1){
                            return '公示中';

                        }else{
                            return '公示结束';

                        }
                    },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '未公示','1' => '公示中', '2' => '公示结束'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'公示状态'],
                'group'=>true,  // enable grouping

            ],
            [
                'attribute'=>'group_status',
                'value' => function($model) {
                        if($model->group_status==0){
                            return '未分部';
                        }else{
                            return '已分部';
                        }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '未分部', '1' => '已分部'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'分部状态'],
                'group'=>true,  // enable grouping

            ],

//            'product_purchase_value',
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
            'product_add_time:date',
//            'product_update_time:date',
//            'purchaser',

        ],
    ]); ?>

</div>
<?php
$group_brocast = Url::toRoute(['group/brocast']);
$group_end_brocast = Url::toRoute(['group/end-brocast']);


$js = <<<JS
    //批量公示
    $('#brocast').on('click',function(){
            var button = $(this);
            button.attr('disabled','disabled');
            var ids = $("#group").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) alert('请选择产品后再操作!');
            $.ajax({
                url:'{$group_brocast}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res=='success') alert('公示产品成功!');
                    button.attr('disabled',false);
                    location.reload();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
                }
            });
    });

//批量结束公示
    $('#end-brocast').on('click',function(){
            var button = $(this);
            button.attr('disabled','disabled');
            var ids = $("#group").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0)  alert('请选择产品后再操作!');
            $.ajax({
                url:'{$group_end_brocast}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res=='success') alert('公示产品结束!');
                    button.attr('disabled',false);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
                }
            });
    });

JS;
$this->registerJs($js);

?>