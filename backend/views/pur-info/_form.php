<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pur-info-form">
    <?php
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'pur_group'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_pic_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'地址格式:https://XXXX.jpg|png|gif等']],


        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'attributes'=>[       // 3 column layout
            'ebay_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'amazon_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'url_1688'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'else_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],
        'contentAfter' => '<div ><br> <br></div>'

    ]);



    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>2.尺寸重量</h3></legend>',
        'attributes'=>[       // 2 column layout
            'pd_length'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_width'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_height'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_throw_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_count_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 6 column layout
            'pd_package'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'',]],
            'is_huge'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',
                ]
            ],
        ],
        'contentAfter' => '<div ><br> <br></div>'

    ]);



    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>3.税费信息</h3></legend>',
        'attributes'=>[       // 2 column layout
            'pd_pur_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'bill_tax_rebate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_purchase_num'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'hs_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],



        ]
    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 4 column layout
            'bill_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'oversea_shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'transaction_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ]
    ]);


    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
//            'contentBefore'=>'<legend class="text-info"><h3>其他信息</h3></legend>',

        'attributes'=>[       // 6 column layout

            'bill_type'=>['type'=>Form::INPUT_RADIO_LIST,
                'items'=>['13%专票'=>'13%专票','增值税普通普票'=>'增值税普通普票', '3%专票'=>'3%专票'],
                'options'=>['placeholder'=>'']],
            'has_shipping_fee'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>是否含运费",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'']],

        ]
    ]);


    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'contentBefore'=>'<legend class="text-info"><h3>4.附加信息</h3></legend>',
        'attributes'=>[       // 1 column layout
            'remark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'','style'=>'height:150px']]
        ]
    ]);

    ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

//css 表单input 变圆润

$this->registerJs("
        $(function () {
            $('.form-control').css('border-radius','7px')
        }); 
        ", \yii\web\View::POS_END);
$readonly_js =<<<JS
        $(function(){
           //只读
            var idReadonly = ["#purinfo-pd_throw_weight","#purinfo-pd_count_weight","#purinfo-is_huge","#purinfo-bill_rebate_amount",
            "#purinfo-shipping_fee","#purinfo-oversea_shipping_fee","#purinfo-transaction_fee","#purinfo-gross_profit","#purinfo-profit_rate",
            "#purinfo-gross_profit_amz","#purinfo-profit_rate_amz","#purinfo-ams_logistics_fee","#purinfo-amz_retail_price_rmb",
            "#purinfo-no_rebate_amount","#purinfo-pur_group"
            ];
            for (var index in idReadonly){
                $(idReadonly[index]).attr("readonly","readonly");
            }
            //必填
            var labelRequire = ['purinfo-pd_title','purinfo-pd_title_en','purinfo-pd_pic_url','purinfo-pd_length','purinfo-pd_width',
            'purinfo-pd_height','purinfo-pd_weight','purinfo-pd_package','purinfo-pd_material','purinfo-pd_pur_costprice','purinfo-bill_tax_rebate',
            'purinfo-retail_price','purinfo-pd_purchase_num','purinfo-bill_type','purinfo-amz_retail_price','purinfo-hs_code'];
             for (var i in  labelRequire){
                 $("label[for='"+labelRequire[i]+"']").addClass("label-require");
             } 
            
            $('.label-require').html(function(_,html) {
                return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
            });


        });
        
JS;
$this->registerJs($readonly_js);
?>

<?php
//计算是否是大件

$compute_js =<<<JS
        $('#w0').on('change',function() {
            var height = $("#purinfo-pd_height").val();
            var width = $("#purinfo-pd_width").val();
            var length = $("#purinfo-pd_length").val();
            
            if(height>=20){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else if(width>=35){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else if(length>=45){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else{
                $(":radio[name ='PurInfo[is_huge]'][value='0']").prop("checked","checked");
            }
                          
            var thow_weight = (height*width*length/5000).toFixed(3); 
            $('#purinfo-pd_throw_weight').val(thow_weight) ;
            var fact_weight = $('#purinfo-pd_weight').val();
            var count_weight;
            if(fact_weight > thow_weight){
                count_weight = fact_weight;
            }else{
                count_weight = thow_weight;
            }
            $("#purinfo-pd_count_weight").val(count_weight);
            
            
            //tax
            var costprice = $("#purinfo-pd_pur_costprice").val(); //含税价格
            var tax_rebate = $("#purinfo-bill_tax_rebate").val(); //退税率
            var bill_rebate_amount = tax_rebate * costprice/100;       //退税金额
            // $("#purinfo-bill_rebate_amount").val(amount_rebate);
            $("#purinfo-bill_rebate_amount").val(bill_rebate_amount);
            
            
            //海运运费估计
            var  shipping_fee;
            var is_huge = $("input[name='PurInfo[is_huge]']:checked").val();
            console.log(is_huge);
            var shipping_fee;
            if(is_huge==0){
                shipping_fee = (count_weight*5).toFixed(3);
            }else{
                shipping_fee = ((length*width*height/1000000)*800).toFixed(3);
            }
            $("#purinfo-shipping_fee").val(shipping_fee);
            
            //海外仓运费预估 purinfo-oversea_shipping_fee 
            // ().toFixed(3)
            
            var oversea_fee;
            if(count_weight<=1){
                oversea_fee = (6.5*$exchange_rate).toFixed(3); //$exchange_rate 是美元汇率
            }else{
                // oversea_fee = (count_weight-1)*1.2*$exchange_rate+6.5*$exchange_rate;
                oversea_fee = (((count_weight-1)*1.2+6.5)*$exchange_rate).toFixed(3) ;
            }
            $("#purinfo-oversea_shipping_fee").val(oversea_fee);
            
            
            //成交费 purinfo-transaction_fee
            var transaction_fee;
            var retail_price = $("#purinfo-retail_price").val(); //预计销售价格 $
            transaction_fee = (retail_price*$exchange_rate*0.13).toFixed(3);
            $("#purinfo-transaction_fee").val(transaction_fee);
            
            //预计销售额 RMB  purinfo-no_rebate_amount
           var no_rebate_amount =(retail_price*$exchange_rate).toFixed(3); 
            
            $("#purinfo-no_rebate_amount").val(no_rebate_amount);
            
            //预估毛利 purinfo-gross_profit
            //预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
            var gross_profit;
            //含税价格 costprice
            gross_profit = (no_rebate_amount-costprice+(bill_rebate_amount)-(shipping_fee)-(oversea_fee)-transaction_fee).toFixed(3) ;
            $("#purinfo-gross_profit").val(gross_profit);
            
        });

JS;

$this->registerJs($compute_js);

?>
