<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/5/14
 * Time: 下午12:00
 */

use yii\helpers\Html;
use kartik\select2\Select2;
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


        <?= $form->field($model_preview, 'headman')->textInput(['maxlength' => true])->hiddenInput([])->label(false);?>
        <?= $form->field($model_preview, 'product_id')->textInput() ->hiddenInput([])->label(false);?>
        <?= $form->field($model_preview, 'priview_time')->textInput() ->hiddenInput([])->label(false);?>

        <?php
        echo Form::widget([
            'model'=>$model_preview,
            'form'=>$form,
            'columns'=>3,
            'contentBefore'=>'<legend class="text-info"><h3>评审数据记录</h3></legend>',
            'attributes'=>[       // 2 column layout
                'ref_url1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url12'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url13'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

            ]
        ]);

        echo Form::widget([
            'model'=>$model_preview,
            'form'=>$form,
            'columns'=>3,
            'attributes'=>[
                'ref_url2'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url22'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url23'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url3'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url4'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);


        echo Form::widget([
            'model'=>$model_preview,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[       // 2 column layout
                'content'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'','style'=>'height:150px']],
            ]
        ]);

        ?>
        <?php
        // Usage with ActiveForm and model
        echo $form->field($model_preview, 'result')->widget(Select2::classname(), [
            'data' => [
                '0'=>'不采购',
                '1'=>'采购',

            ],
            'options' => ['placeholder' => '选择结果.....'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>


        <div class="form-group">
            <div style="text-align:right">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-lg']) ?>

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>


<?php  $form = ActiveForm::begin(['id' => 'auto-compute-form'])?>
<?php
echo Form::widget([
    'model'=>$purinfo,
    'form'=>$form,
    'columns'=>6,
    'contentBefore'=>'<legend class="text-info"><h3>评审数据计算</h3></legend>',
    'attributes'=>[       // 4 column layout
        'retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        'ams_logistics_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        'profit_rate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

    ]
]);

echo Form::widget([
    'model'=>$purinfo,
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

//css 表单input 变圆润

$this->registerJs("
        $(function () {
            $('.form-control').css('border-radius','7px')
        }); 
        ", \yii\web\View::POS_END);

//span * 必填字段

$require_js = <<<JS
    $(function(){
         $("label[for='headman-content'] ").addClass("label-require");
         $("label[for='headman-result'] ").addClass("label-require");
            
            $('.label-require').html(function(_,html) {
                return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
            });
    });
JS;

$this->registerJs($require_js);


?>
<?php

//评审计算器

$preview_js= <<<JS

    $('#auto-compute-form').on('change',function(){
         var preview_retail_price = $('#purinfo-retail_price').val(); //评审人填写的  售价 $
         var amz_fee = $('#purinfo-ams_logistics_fee').val(); //amz物流计算器 计算的费用 $
         var shipping_fee  = $('#purinfo-shipping_fee').val(); //海运运费
         //预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
         //评审人计算的毛利¥ = (评审人售价$)*rate-含税价格+退税金额-海运运费-(AMZ计算费用$)*rate
            var costprice = $("#purinfo-pd_pur_costprice").val(); //含税价格
            var tax_rebate = $("#purinfo-bill_tax_rebate").val(); //退税率
            var preview_profit_float = preview_retail_price * $exchange_rate -(1-tax_rebate/100)*costprice-shipping_fee-amz_fee*$exchange_rate;
            var preview_profit = (preview_profit_float).toFixed(3);
           $('#purinfo-gross_profit').val(preview_profit);
           
           //审核计算的毛利率 
           
           var profit_rate = (preview_profit*100/(preview_retail_price * $exchange_rate)).toFixed(3);
           $('#purinfo-profit_rate').val(profit_rate);

           
           
    
    });

JS;
$this->registerJs($preview_js);
?>


