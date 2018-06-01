<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupPurSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '今日新品分组公示');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

<!--    <h1>--><?php //echo Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('确认公示', ['id' => 'brocast', 'class' => 'btn btn-primary']) ;?>
        <?=  Html::button('公示结束', ['id' => 'end-brocast', 'class' => 'btn btn-info']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export'=>false,
//        'options' =>['style'=>'overflow:auto; white-space:nowrap;'],
        'id'=> 'group-pur',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
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
//            'pur_info_id',
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
                'attribute'=>'source',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->source=='0'){
                        return '销售推荐';

                    }else{
                        return '自主开发';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '自主开发', '0' => '销售推荐'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'产品来源'],
                'group'=>true,  // enable grouping
            ],

//            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            [
                'attribute'=>'is_huge',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->is_huge=='0'){
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
                'filterInputOptions'=>['placeholder'=>'是否大件'],
                'group'=>true,  // enable grouping
            ],

            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
//            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            [
                'attribute'=>'has_shipping_fee',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->has_shipping_fee=='0'){
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
                'filterInputOptions'=>['placeholder'=>'是否含运'],
                'group'=>true,  // enable grouping
            ],
            'bill_type',
            'bill_tax_value',
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
            'pd_create_time:date',

            'remark',
//            'parent_product_id',

        ],
    ]); ?>

</div>

<?php
$group_brocast = Url::toRoute(['brocast']);
$group_end_brocast = Url::toRoute(['end-brocast']);


$js = <<<JS
    //批量公示
    $('#brocast').on('click',function(){
            var button = $(this);
            button.attr('disabled','disabled');
            var ids = $("#group-pur").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0)  alert('请选择产品后再操作!');
            $.ajax({
                url:'{$group_brocast}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
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
            var ids = $("#group-pur").yiiGridView("getSelectedRows");
            if(ids.length ==0) alert('请选择产品后再操作!');
            $.ajax({
                url:'{$group_end_brocast}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
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