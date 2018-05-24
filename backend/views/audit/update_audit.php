<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/5/14
 * Time: 下午12:00
 */

use yii\helpers\Html;
use kartik\select2\Select2;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model_preview backend\models\Preview */

$this->title = Yii::t('app', '更新评审: ' . $model_preview->preview_id, [
    'nameAttribute' => '' . $model_preview->preview_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model_preview->preview_id, 'url' => ['view', 'id' => $model_preview->preview_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="preview-update">

    <?= $this->render('view', [
        'model' => $purinfo,


    ]) ?>


    <div class="preview-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model_preview, 'member')->textInput(['maxlength' => true])->hiddenInput([])->label(false);?>
        <?= $form->field($model_preview, 'product_id')->textInput() ->hiddenInput([])->label(false);?>

        <?php
        // Usage with ActiveForm and model
        echo $form->field($model_preview, 'result')->widget(Select2::classname(), [
            'data' => [
                    ''=>'',
                '采样'=>'采样',
                '拒绝'=>'拒绝',
                '可以开发'=>'可以开发',
            ],
            'options' => ['placeholder' => '选择结果.....'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>
        <?= $form->field($model_preview, 'content')->textarea(['maxlength' => true,'rows' => '7']) ?>

        <?= $form->field($model_preview, 'priview_time')->textInput() ->hiddenInput([])->label(false);?>

        <?= $form->field($model_preview, 'member_id')->textInput() ->hiddenInput([])->label(false);?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>





    </div>

    <?php  $form = ActiveForm::begin(['id' => 'auto-compute-form'])?>
        <?php
            echo Form::widget([
                'model'=>$purinfo,
                'form'=>$form,
                'columns'=>6,
                'contentBefore'=>'<legend class="text-info"><h3>评审数据计算¥</h3></legend>',
                'attributes'=>[       // 4 column layout
                    'no_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'oversea_shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'oversea_shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'transaction_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                ]
            ]);
        ?>
    <?php ActiveForm::end(); ?>


</div>
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
            transaction_fee = (retail_price *0.13).toFixed(3);
            $("#purinfo-transaction_fee").val(transaction_fee);
            
            //预计销售额 RMB  purinfo-no_rebate_amount
            
            $("#purinfo-no_rebate_amount").val(retail_price*$exchange_rate);
            
            //预估毛利 purinfo-gross_profit
            //预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
            var gross_profit;
            //含税价格 costprice
            gross_profit = (retail_price*$exchange_rate-costprice+bill_rebate_amount-shipping_fee-oversea_fee-transaction_fee*$exchange_rate).toFixed(3) ;
            $("#purinfo-gross_profit").val(gross_profit);
            
        });
        $()

JS;

//$this->registerJs($compute_js);



?>

<?php
$preview_js= <<<JS

    $('#auto-compute-form').on('change',function(){
        
         var no_rebate_amount = $('#purinfo-no_rebate_amount').val();  //售价 RMB
         console.log(no_rebate_amount);
         var shipping_fee = $('#purinfo-oversea_shipping_fee').val();
         console.log(shipping_fee); 
         var transaction_fee = $('#purinfo-transaction_fee').val();
         console.log(transaction_fee);
       
    
    });

  
JS;


$this->registerJs($preview_js);
?>


