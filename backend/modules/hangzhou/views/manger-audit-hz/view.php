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
            'old_costprice',
            'has_shipping_fee',
            'bill_type',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',

            ['attribute'=>'ebay_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'amazon_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'url_1688','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'else_url','format'=>['url',['target'=>'_blank']]],
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'retail_price',
            'no_rebate_amount',
            'gross_profit',
            'profit_rate',
            'amz_retail_price',
            'amz_retail_price_rmb',
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
            [
                'attribute'=>'trading_company',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->trading_company ==1 ){
                        return '是';
                    }else{
                        return '否';
                    }
                },
            ],
            [
                'attribute'=>'is_patent_right',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->is_patent_right ==1 ){
                        return '是';
                    }elseif($model->is_patent_right ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],
            [
                'attribute'=>'is_third_party_abroad_right',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->is_third_party_abroad_right ==1 ){
                        return '是';
                    }elseif($model->is_third_party_abroad_right ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],
            [
                'attribute'=>'promise_rights',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->promise_rights ==1 ){
                        return '是';
                    }elseif($model->promise_rights ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],
            [
                'attribute'=>'special_auth_FDA',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->special_auth_FDA ==1 ){
                        return '是';
                    }elseif($model->special_auth_FDA ==0){
                        return '否';
                    }else{
                        return '未判断';
                    }
                },
            ],

        ],
    ]) ?>

    <?php
        if($num == 2){
            echo $this->render('preview_view', [
                'preview_model' => $preview,
            ]) ;
            echo $this->render('preview_view', [
                'preview_model' => $preview2,
            ]) ;
        }elseif($num==3){
            echo $this->render('preview_view', [
                'preview_model' => $preview,
            ]) ;
            echo $this->render('preview_view', [
                'preview_model' => $preview2,
            ]) ;
            echo $this->render('preview_view', [
                'preview_model' => $preview3,
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
        'data' => $data,
        'num' => $num
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
            'pd_pur_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],//含税价格
            'bill_tax_rebate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],   //退税率
            'bill_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],   //退税e
            'shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']], //海运运费
            'oversea_shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],//海外仓运费

        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 4 column layout
            'retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'transaction_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'profit_rate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ]
    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 4 column layout
            'amz_retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'ams_logistics_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'gross_profit_amz'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'profit_rate_amz'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

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
<?php

//css 表单input 变圆润

$this->registerJs("
        $(function () {
            $('.form-control').css('border-radius','7px')
        }); 
        ", \yii\web\View::POS_END);

//span * 必填字段

$require_js = <<<JS
    $(function(){
         $("label[for='preview-content'] ").addClass("label-require");
         $("label[for='preview-result'] ").addClass("label-require");
            
        $('.label-require').html(function(_,html) {
            return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
        });
            
            //只读
             $("#purinfo-pd_pur_costprice").attr("readonly","readonly");
             $("#purinfo-bill_tax_rebate").attr("readonly","readonly");
             $("#purinfo-shipping_fee").attr("readonly","readonly");
             $("#purinfo-oversea_shipping_fee").attr("readonly","readonly");
             $("#purinfo-transaction_fee").attr("readonly","readonly");
             $("#purinfo-bill_rebate_amount").attr("readonly","readonly");
             
             $("#purinfo-gross_profit").attr("readonly","readonly");
             $("#purinfo-profit_rate").attr("readonly","readonly");
             $("#purinfo-gross_profit_amz").attr("readonly","readonly");
             $("#purinfo-profit_rate_amz").attr("readonly","readonly");
    });
JS;

$this->registerJs($require_js);

?>
<?php

//评审计算器

$preview_js= <<<JS

    $('#auto-compute-form').on('change',function(){
         
        //eBay审核计算的毛利率 预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
         var eBay_retail_price = $('#purinfo-retail_price').val(); //评审人填写的  售价 $ eBay
       
         var shipping_fee  = $('#purinfo-shipping_fee').val();       //海运运费
         var oversea_fee  = $('#purinfo-oversea_shipping_fee').val(); //海外仓运费 
         var transaction_fee  = (eBay_retail_price* $exchange_rate*0.13).toFixed(3);  //成交费 
            
         var costprice = $("#purinfo-pd_pur_costprice").val(); //含税价格
         var tax_rebate = $("#purinfo-bill_tax_rebate").val(); //退税率
           
         var eBay_profit = (eBay_retail_price * $exchange_rate -(1-tax_rebate/100)*costprice-shipping_fee-oversea_fee-transaction_fee).toFixed(3);
         $('#purinfo-gross_profit').val(eBay_profit);
           var profit_rate = (eBay_profit*100/(eBay_retail_price * $exchange_rate)).toFixed(3);
           $('#purinfo-profit_rate').val(profit_rate);  
           $('#purinfo-transaction_fee').val(transaction_fee);  
           
           
     //amz审核计算
     //评审人计算的毛利¥ = (评审人售价$)*rate-含税价格+退税金额-海运运费-(AMZ计算费用$)*rate

           var amz_fee = $('#purinfo-ams_logistics_fee').val(); //amz物流计算器 计算的费用 $
           var amz_retail_price = $('#purinfo-amz_retail_price').val(); //评审人填写的  售价 $ Amazon
           var amz_profit =(amz_retail_price * $exchange_rate -(1-tax_rebate/100)*costprice-shipping_fee-amz_fee*$exchange_rate).toFixed(3);
           var profit_rate_amz = (amz_profit*100/(amz_retail_price * $exchange_rate)).toFixed(3);
          
           $('#purinfo-gross_profit_amz').val(amz_profit);
           $('#purinfo-profit_rate_amz').val(profit_rate_amz);
    

    
    });

JS;
$this->registerJs($preview_js);
?>
