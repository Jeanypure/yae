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
        <?php echo Html::button('复制选中产品',['class' => 'btn btn-default' ,'id'=>'copy-good'])?>

        <?php echo Html::button('确认提交',['class' => 'btn btn-info' ,'id'=>'is_submit'])?>
        <?php echo Html::button('取消提交',['class' => 'btn btn-primary' ,'id'=>'un_submit'])?>


    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id'=>'goodssku',
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
$copy_good = Url::toRoute(['copy']);
$copy =<<<JS
        $(function() {
          $('#copy-good').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                var ids =  $('#goodssku').yiiGridView("getSelectedRows");
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

<?php

// 标记产品状态    0 uncommitted  1 commit
//功能放到 index 批量提交    取消提交

$commit = Url::toRoute(['commit']);
$uncommitted = Url::toRoute(['cancel']);
$is_submit = <<<JS

    //批量提交
    $('#is_submit').on('click',function(){
         var button = $(this);
         button.attr('disabled','disabled');
        var ids =  $('#goodssku').yiiGridView("getSelectedRows");
        var str_id  = ids.toString();
        console.log(ids);
        console.log(str_id);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$commit}", 
         type: 'post',
         data:{id:str_id},
         success:function(res){
           if(res=='success') alert('提交产品成功!');     
           button.attr('disabled',false);
           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
         }
      
    });
});

//取消提交
    $('#un_submit').on('click',function(){
        var button = $(this);
         button.attr('disabled','disabled');
        var ids =  $('#goodssku').yiiGridView("getSelectedRows");
        var str_id  = ids.toString();
        console.log(ids);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$uncommitted}", 
         type: 'post',
         data:{id:str_id},
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
