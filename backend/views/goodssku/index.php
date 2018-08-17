<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsskuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '产品档案';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodssku-index">


    <p>
        <?= Html::a('直接创建产品档案', ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo Html::button('复制选中产品',['class' => 'btn btn-info' ,'id'=>'copy-good'])?>
        <?php echo Html::button('导出选中项',['class' => 'btn btn-warning' ,'id'=>'export-freight-fee'])?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id'=>'export-to-eccang',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作'
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
            'declared_value',
            'currency_code',
            'old_sku',
            'is_quantity_check',
            'contain_battery',
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
$export = Url::toRoute(['export']);
$copy_good = Url::toRoute(['copy']);
$export_debit =<<<JS
        $(function() {
          $('#export-freight-fee').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                var ids =  $('#export-to-eccang').yiiGridView("getSelectedRows");
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

$copy =<<<JS
        $(function() {
          $('#copy-good').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                var ids =  $('#export-to-eccang').yiiGridView("getSelectedRows");
                var str_id  = ids.toString();
                    console.log(ids);
                    console.log(str_id);
                if(ids==false) alert('请选择!') ;
                $.ajax({
                 url: "{$copy_good}", 
                 type: 'get',
                 data:{id:str_id},
                 success:function(res){
                     if(res==1) {alert('复制成功!')}else{ alert('出错了！')};
                    button.attr('disabled',false);
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                  });
             });
        });
JS;
$this->registerJs($copy);

?>