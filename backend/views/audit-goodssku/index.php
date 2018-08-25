<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsskuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '审核产品档案';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodssku-index">

    <p>
        <?php echo Html::button('导出excel到易仓',['class' => 'btn btn-success' ,'id'=>'export-freight-fee'])?>
        <?php echo Html::button('标记已导易仓',['class' => 'btn btn-info' ,'id'=>'sign-import-eccang'])?>
        <?php echo Html::button('取消标记',['class' => 'btn btn-primary' ,'id'=>'cancel-sign'])?>
        <?php echo Html::button('导入NetSuite',['class' => 'btn btn-warning' ,'id'=>'export-netsuite'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id'=>'audit-goodssku',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update}',
                'buttons' => [
                    /*'export-ns' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-export"></span>', $url, ['title' => '导入NS' ] );
                    },*/
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => '审核记录' ] );
                    },
                ],
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->image_url. "' width='100' height='100'>";


                }
            ],
            'sku',

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
                'contentOptions'=> ['style' => 'width: 50%; overflow:auto;word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'has_commit',
                'value' => function($model) {
                    if($model->has_commit==1){
                        return '是';
                    }else{
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
                'filterInputOptions'=>['placeholder'=>'提交?'],

            ],

            [
                'attribute'=>'has_toeccang',
                'value' => function($model) {
                    if($model->has_toeccang==1){
                        return '是';
                    }else{
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
                'filterInputOptions'=>['placeholder'=>'导易仓?'],

            ],
            [
                'attribute'=>'has_tons',
                'value' => function($model) {
                    if($model->has_tons==1){
                        return '是';
                    }else{
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
                'filterInputOptions'=>['placeholder'=>'导NS?'],

            ],
            [
                'attribute'=>'audit_result',
                'value' => function($model) {
                    if($model->audit_result==1){
                        return '是';
                    }else{
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
                'attribute'=>'audit_content',
                'value' => function($model) { return $model->audit_content;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            'declared_value',
            'currency_code',
            'old_sku',
            [
                'attribute'=>'is_quantity_check',
                'value' => function($model) {
                    if($model->is_quantity_check==1){
                        return '是';
                    }else{
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
                'filterInputOptions'=>['placeholder'=>'质检?'],

            ],
            [
                'attribute'=>'contain_battery',
                'value' => function($model) {
                    if($model->contain_battery==1){
                        return '是';
                    }else{
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
                'filterInputOptions'=>['placeholder'=>'含电池?'],

            ],
            'qty_of_ctn',
           /* 'ctn_length',
            'ctn_width',
            'ctn_height',
            'ctn_fact_weight',*/
           /* 'sale_company',
            'vendor_code',
            'origin_code',
            'min_order_num',
            'pd_get_days',
            'pd_costprice_code',
            'pd_costprice',
            'bill_name',
            'bill_unit',
            'brand',*/
            'sku_mark',

        ],
    ]); ?>
</div>


<?php
//导出excel到易仓
$export = Url::toRoute(['export']);
$export_debit =<<<JS
        $(function() {
          $('#export-freight-fee').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                var ids =  $('#audit-goodssku').yiiGridView("getSelectedRows");
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

<?php
//导入NetSuite
$to_netsuite = Url::toRoute(['export-ns']);
$export_ns = <<<JS
    $(function() {
      $('#export-netsuite').on('click',function(){
                var button = $(this);
                 button.attr('disabled','disabled');
                var ids =  $('#audit-goodssku').yiiGridView("getSelectedRows");
                var str_id  = ids.toString();
                if(ids==false) alert('请选择!') ;
                $.ajax({
                 url: "{$to_netsuite}", 
                 type: 'get',
                 data:{id:str_id},
                 success:function(res){
                     var obj = JSON.parse(res);
                   button.attr('disabled',false);
                   if(obj.code =='200 OK'){ alert(obj.message); }
                   else{alert(obj.error.code+'->'+obj.error.message);}
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                });
                });
      });
JS;

$this->registerJs($export_ns);

?>


