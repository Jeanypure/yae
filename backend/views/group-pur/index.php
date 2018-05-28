<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupPurSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '采购自主开产品--分组公示');
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
            'pur_group',
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
            'brocast_status',
//            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            'is_huge',
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
//            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
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