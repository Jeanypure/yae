<?php

use yii\widgets\DetailView;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-view">

    <p>
        <img src="<?php echo $model->pd_pic_url?>" alt="" width="100" height="100">
    </p>

    <p>
<!--        --><?php //echo  Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->pur_info_id], ['class' => 'btn btn-primary']) ?>
        <?php
//        echo  Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->pur_info_id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]);
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pur_info_id',
            'purchaser',
            'pur_group',
            'pd_title',
            'pd_title_en',
            ['attribute'=>'pd_pic_url','format'=>['url',['target'=>'_blank']]],
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
            ['attribute'=>'ebay_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'amazon_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'url_1688','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'else_url','format'=>['url',['target'=>'_blank']]],
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'profit_rate',
            'gross_profit_amz',
            'profit_rate_amz',
            'remark',
            'source',
            'member',
            'preview_status',
            'brocast_status',
            'master_member',
            'master_result',
            'master_mark',

        ],
    ]) ?>

    <?php
        if($num>1){
            echo $this->render('preview_view', [
                'preview_model' => $preview,
            ]) ;
            echo $this->render('preview_view', [
                'preview_model' => $preview2,
            ]) ;
        }else{
            echo $this->render('preview_view', [
                'preview_model' => $preview,
            ]) ;


        }


    ?>

    <?php

    echo $this->render('update_audit', [
        'model' => $model_update,
    ])
    ?>

    <?php  $form = ActiveForm::begin(['id' => 'auto-compute-form'])?>
    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>评审数据计算</h3></legend>',
        'attributes'=>[       // 4 column layout
            'retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'ams_logistics_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 4 column layout
            'pd_pur_costprice'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],//含税价格
            'bill_tax_rebate'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],   //退税率
            'shipping_fee'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']], //海运运费
        ]
    ]);

    ?>
    <?php ActiveForm::end(); ?>
    <?php

    //评审计算器

    $preview_js= <<<JS

    $('#auto-compute-form').on('change',function(){
         var preview_retail_price = $('#purinfo-retail_price').val(); //评审人填写的  售价 $
         var amz_fee = $('#purinfo-ams_logistics_fee').val(); //amz物流计算器 计算的费用 $
         var shipping_fee  = $('#purinfo-shipping_fee').val(); //海运运费
         //  //预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
         //评审人计算的毛利¥ = (评审人售价$)*rate-含税价格+退税金额-海运运费-(AMZ计算费用$)*rate
            var costprice = $("#purinfo-pd_pur_costprice").val(); //含税价格
            var tax_rebate = $("#purinfo-bill_tax_rebate").val(); //退税率
            var  preview_profit_float = preview_retail_price * $exchange_rate -(1-tax_rebate/100)*costprice-shipping_fee-amz_fee*$exchange_rate;
            var preview_profit = (preview_profit_float).toFixed(3);
           $('#purinfo-gross_profit').val(preview_profit);
    
    });

JS;
    $this->registerJs($preview_js);
    ?>


</div>
