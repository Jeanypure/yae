<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '编辑产品: {nameAttribute}', [
    'nameAttribute' => $model->pur_info_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '产品'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pur_info_id, 'url' => ['view', 'id' => $model->pur_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="pur-info-update">

    <p>
        <img src="<?php echo $model->pd_pic_url ;?>" alt="" width="100" height="100">

    </p>

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
                'pd_title'=>['type'=>Form::INPUT_TEXT,
                    'labelOptions'=>['class'=>'label-require'],
                    'options'=>['placeholder'=>'','class'=>'label-require']],
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
            'attributes'=>[       // 2 column layout
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
                'bill_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'oversea_shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'transaction_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout

                'retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'no_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'profit_rate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],


            ]
        ]);


        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout
                'amz_retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'amz_retail_price_rmb'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'gross_profit_amz'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'profit_rate_amz'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout
                'selling_on_amz_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'amz_fulfillment_cost'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ams_logistics_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout
                'pd_purchase_num'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                'hs_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                'bill_type'=>['type'=>Form::INPUT_RADIO_LIST,
                    'items'=>['16%专票'=>'16%专票','增值税普通普票'=>'增值税普通普票', '3%专票'=>'3%专票'],
                    'label'=>"<span style = 'color:red'><big>*</big></span>开票类型",
                    'options'=>['placeholder'=>'']],
                'has_shipping_fee'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>是否含运费",
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'']],
                'trading_company'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>供应商是否是贸易公司",
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

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout
                'pur_info_id'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],
                'master_result'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],
            ]

        ]);


        ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
        <div class="form-group">
            <?=  Html::Button('已议价需重新评审', ['id' => 'reappraisal', 'class' => 'btn btn-primary']) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>



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
            $("#purinfo-pd_throw_weight").attr("readonly","readonly");
            $("#purinfo-pd_count_weight").attr("readonly","readonly");
            $("#purinfo-is_huge").attr("readonly","readonly");
            $("#purinfo-bill_rebate_amount").attr("readonly","readonly");
            $("#purinfo-shipping_fee").attr("readonly","readonly");
            $("#purinfo-oversea_shipping_fee").attr("readonly","readonly");
            $("#purinfo-transaction_fee").attr("readonly","readonly");
            $("#purinfo-gross_profit").attr("readonly","readonly");
            $("#purinfo-profit_rate").attr("readonly","readonly");
              
            $("#purinfo-gross_profit_amz").attr("readonly","readonly");
            $("#purinfo-profit_rate_amz").attr("readonly","readonly");
            $("#purinfo-ams_logistics_fee").attr("readonly","readonly");
            
            $("#purinfo-amz_retail_price_rmb").attr("readonly","readonly");

            
            $("#purinfo-no_rebate_amount").attr("readonly","readonly");
            $("#purinfo-pur_group").attr("readonly","readonly");
            
            $("label[for='purinfo-pd_title'] ").addClass("label-require");
            $("label[for='purinfo-pd_title_en'] ").addClass("label-require");
            $("label[for='purinfo-pd_pic_url'] ").addClass("label-require");
            $("label[for='purinfo-pd_length'] ").addClass("label-require");
            $("label[for='purinfo-pd_width'] ").addClass("label-require");
            $("label[for='purinfo-pd_height'] ").addClass("label-require");
            $("label[for='purinfo-pd_weight'] ").addClass("label-require");
            $("label[for='purinfo-pd_package'] ").addClass("label-require");
            $("label[for='purinfo-pd_material'] ").addClass("label-require");
            $("label[for='purinfo-pd_pur_costprice'] ").addClass("label-require");
            $("label[for='purinfo-bill_tax_rebate'] ").addClass("label-require");
            $("label[for='purinfo-retail_price'] ").addClass("label-require");
            $("label[for='purinfo-pd_purchase_num'] ").addClass("label-require");
            $("label[for='purinfo-bill_type'] ").addClass("label-require");
            $("label[for='purinfo-amz_retail_price'] ").addClass("label-require");
            $("label[for='purinfo-hs_code'] ").addClass("label-require");


            
            $('.label-require').html(function(_,html) {
                return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
            });
            
            if(master_result==2)
            {
                $('#reappraisal').show();
            }else{
                 $('#reappraisal').hide();
            }


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
            var no_rebate_amount = (retail_price*$exchange_rate).toFixed(3)
            
            $("#purinfo-no_rebate_amount").val(no_rebate_amount);
            
            //预估毛利 purinfo-gross_profit
            //预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
            var gross_profit;
            //含税价格 costprice
            gross_profit = (no_rebate_amount-costprice+(bill_rebate_amount)-(shipping_fee)-(oversea_fee)-transaction_fee).toFixed(3) ;
            $("#purinfo-gross_profit").val(gross_profit);
              //毛利率--eBay
            var profit_rate = (gross_profit*100/no_rebate_amount).toFixed(3);
             $("#purinfo-profit_rate").val(profit_rate);
             
                //amz 最低售价 $ rmb
            var amz_retail_price = $("#purinfo-amz_retail_price").val();
            var amz_retail_price_rmb = (amz_retail_price*$exchange_rate).toFixed(3);
            $("#purinfo-amz_retail_price_rmb").val(amz_retail_price_rmb);
             
             //amz   amz_fulfillment_cost
             var fulfillment_cost = $("#purinfo-amz_fulfillment_cost").val();
             
             
             // amz selling_on_amz_fee
             var amz_selling_on_amz_fee = $("#purinfo-selling_on_amz_fee").val();
             
             //amz 物流计算费用 $ = 成交费+派送费
             // var ams_logistics_fee = $("#purinfo-ams_logistics_fee").val();
             var ams_logistics_fee = (parseFloat(fulfillment_cost) + parseFloat(amz_selling_on_amz_fee)).toFixed(3);
             $("#purinfo-ams_logistics_fee").val(ams_logistics_fee);
            
             
             //amz 成交费 是 售价的15%
             var amz_transaction_fee = (retail_price*$exchange_rate*0.15).toFixed(3);
             
             //amz 毛利¥
             //amz 毛利率%
             
            var gross_profit_amz;
            gross_profit_amz = (amz_retail_price_rmb-costprice+(bill_rebate_amount)-(ams_logistics_fee*$exchange_rate)-shipping_fee).toFixed(3) ;
            $("#purinfo-gross_profit_amz").val(gross_profit_amz);

           
             //amz毛利率
            var profit_rate_amz = (gross_profit_amz*100/amz_retail_price_rmb).toFixed(3);
             $("#purinfo-profit_rate_amz").val(profit_rate_amz);
             
          
            
        });

JS;

$this->registerJs($compute_js);

?>

<?php
//需要议价和谈其他条件
$reassessment = Url::toRoute('assessment');

$reJs = <<<JS
        $('#reappraisal').on('click',function(){
            var button = $(this);
            ids = $('#purinfo-pur_info_id').val();
            button.attr('disabled','disabled');
            $.ajax({
            url:'{$reassessment}',
            type:'post',
            data:{id:ids},
            success:function(res){
                if(res=='success') alert('重新提交评审成功!');
                button.attr('disabled',false);
                location.reload();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                button.attr('disabled',false);
            }
            
            });
        });
JS;

$this->registerJs($reJs);

?>
