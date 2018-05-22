<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompleteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '销售推荐');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

    <?php Pjax::begin(); ?>
    <p>
<!--        --><?php //echo Html::button('接受',['class' => 'btn btn-success' ,'id'=>'accept'])?>
<!--        --><?php //echo  Html::button('拒绝',['class' => 'btn btn-danger' ,'id'=>'reject'])?>
    </p>
    <?php
//     echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id'=>'pur_complete',
        'options'=>[
            'style'=>'overflow:auto; white-space:nowrap'
        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=> '操作'

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
//            'purchaser',
//            'accept_status_pur',
//            'pur_group',
            'pd_title',
            'pd_title_en',
            'pd_pic_url:url',
            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            'is_huge',
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
            'pd_material',
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
            'ebay_url:url',
            'amazon_url:url',
            'url_1688:url',
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'remark',
//            'parent_product_id',
            'source',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php
$accept = Url::toRoute(['accept']);
$reject = Url::toRoute(['reject']);


$js = <<<JS
    //批量接受
    $('#accept').on('click',function(){
            var ids = $("#pur_complete").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) return false;
            $.ajax({
                url:'{$accept}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
                }
            });
    });

//批量拒绝
    $('#reject').on('click',function(){
            var ids = $("#pur_complete").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) return false;
            $.ajax({
                url:'{$reject}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
                    location.reload();
                }
            });
    });

JS;
$this->registerJs($js);



?>