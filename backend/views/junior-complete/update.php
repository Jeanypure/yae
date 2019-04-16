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
                    'items'=>['13%专票'=>'13%专票','增值税普通普票'=>'增值税普通普票', '3%专票'=>'3%专票'],
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
                'is_patent_right'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>工厂对此产品是否有专利权或商标权",
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'']],
                'is_third_party_abroad_right'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>国外第三方对此产品是否有专利权或商标权",
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'']],
                'promise_rights'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>供应商承诺没有知识产权方面问题",
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'']],
                'special_auth_FDA'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>是否需要特殊认证FDA或者电器CE Rosh",
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
            
            $("#reappraisal").hide();

            var master_result = $('#purinfo-master_result').val();
            if(master_result==2){ $('#reappraisal').show();}



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
            
            var height_in = $("#purinfo-pd_height").val()*0.39.toFixed(3);
            var width_in = $("#purinfo-pd_width").val()*0.39.toFixed(3);
            var length_in = $("#purinfo-pd_length").val()*0.39.toFixed(3);
           
            if(parseFloat(height_in)>=8){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else if(parseFloat(width_in)>=14){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else if(parseFloat(length_in)>=18 ){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else{
                $(":radio[name ='PurInfo[is_huge]'][value='0']").prop("checked","checked");
            }
                          
            var amz_pound_weight = (height_in*width_in*length_in/139).toFixed(3); // amz计算重量 抛重 单位 磅
            var thow_weight = (height_in*width_in*length_in*0.45/139).toFixed(3); //抛重 kg
           
            $('#purinfo-pd_throw_weight').val(thow_weight) ;
            var fact_weight = $('#purinfo-pd_weight').val();
            var count_weight;
       
            if(parseFloat(fact_weight) > parseFloat(thow_weight)){
                count_weight = fact_weight;
            }else{
                count_weight = thow_weight;
            }
            
            var amz_pound_count_weight = (count_weight*2.2).toFixed(3); //amz 商品重量 体积重量 较大值  磅
            $("#purinfo-pd_count_weight").val(count_weight);
            //tax
            var costprice = parseFloat($("#purinfo-pd_pur_costprice").val()); //含税价格
           
            var tax_rebate = $("#purinfo-bill_tax_rebate").val(); //退税率
            var bill_rebate_amount = (tax_rebate * costprice/100).toFixed(3);       //退税金额
            // $("#purinfo-bill_rebate_amount").val(amount_rebate);
            $("#purinfo-bill_rebate_amount").val(bill_rebate_amount);
            
            
            //海运运费估计
            var  shipping_fee;
            var is_huge = $("input[name='PurInfo[is_huge]']:checked").val();
           
            var shipping_fee;
            if(is_huge==0){
                shipping_fee = (count_weight*5).toFixed(3);
            }else{
                shipping_fee = ((length*width*height/1000000)*800).toFixed(3);
            }
            $("#purinfo-shipping_fee").val(shipping_fee);
            
            //海外仓运费预估 purinfo-oversea_shipping_fee 
            //是大件在判断
             //小号 中号 大号 特殊大件
             //small_huge 小号  70磅  长60in 宽30in 长度+周长130in 
             //middle_huge 中号  150磅  长108in  长度+周长 130in 
             //big_huge 大号  150磅  长108in  长度+周长 165in 
             //else_huge 特殊大件  >150磅  长60in 宽30in  >长度+周长165in 
             var oversea_fee =0 ;
            if(is_huge==1){
                amz_pound_count_weight = parseFloat(amz_pound_count_weight)+1; //大件要加上包装 1磅
                var perimeter = (width_in+height_in)*2 ; //周长   
                var len_cir = length_in+perimeter;
                if(amz_pound_count_weight<70 && length_in < 60 && width_in< 30 && len_cir< 130){ //small_huge = 1;
                    oversea_fee = ((8.13 + (amz_pound_count_weight-2)*0.38)*$exchange_rate).toFixed(3);
                }else if(amz_pound_count_weight<150 && length_in < 108  && len_cir< 130){ // middle_huge = 1;
                    oversea_fee = ((9.44 + (amz_pound_count_weight-2)*0.38)*$exchange_rate).toFixed(3);
                }else if(amz_pound_count_weight<150 && length_in < 108  && len_cir< 165){ // big_huge=1;
                     oversea_fee = ((73.18 + (amz_pound_count_weight-90)*0.79)*$exchange_rate).toFixed(3);
                }else if(amz_pound_count_weight>150 || length_in > 108  || len_cir> 165){ //else_huge = 1;
                     oversea_fee = ((137.32 +(amz_pound_count_weight-90)*0.91)*$exchange_rate).toFixed(3);
                }
                
            }else{
                if(count_weight<=1){
                oversea_fee = (6.5*$exchange_rate).toFixed(3); //$exchange_rate 是美元汇率
                }else{
                    // oversea_fee = (count_weight-1)*1.2*$exchange_rate+6.5*$exchange_rate;
                    oversea_fee = (((count_weight-1)*1.2+6.5)*$exchange_rate).toFixed(3) ;
                }
            }

            $("#purinfo-oversea_shipping_fee").val(oversea_fee);
                               
         
            //成交费 purinfo-transaction_fee
            var transaction_fee;
            var retail_price = $("#purinfo-retail_price").val(); //预计销售价格 $
            transaction_fee = (retail_price*$exchange_rate*0.13).toFixed(3);
            $("#purinfo-transaction_fee").val(transaction_fee);
            
            //预计销售额 RMB  purinfo-no_rebate_amount
            var no_rebate_amount = parseFloat((retail_price*$exchange_rate)).toFixed(3)
            
            $("#purinfo-no_rebate_amount").val(no_rebate_amount);
            
            //预估毛利 purinfo-gross_profit
            //预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
            var gross_profit;
                                        

            //含税价格 costprice 
            gross_profit = (parseFloat(no_rebate_amount)- parseFloat(costprice)+ parseFloat(bill_rebate_amount)- parseFloat(shipping_fee)- parseFloat(oversea_fee)- parseFloat(transaction_fee)).toFixed(3) ;
             
            $("#purinfo-gross_profit").val(gross_profit);
              //毛利率--eBay
            var profit_rate = (gross_profit*100/no_rebate_amount).toFixed(3);
             $("#purinfo-profit_rate").val(profit_rate);
             
                //amz 最低售价 $ rmb
            var amz_retail_price = $("#purinfo-amz_retail_price").val() ;
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
            
             //amz 毛利¥
             //amz 毛利率%
             
            var gross_profit_amz;
            gross_profit_amz = (parseFloat(amz_retail_price_rmb)-parseFloat(costprice)+parseFloat(bill_rebate_amount)-parseFloat(ams_logistics_fee*$exchange_rate)-parseFloat(shipping_fee)).toFixed(3) ;
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
