<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goodssku-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'sku'=>['type'=>Form::INPUT_TEXT, 'options'=>['class'=>'required ']],
            'old_sku'=>['type'=>Form::INPUT_TEXT],
            'pd_title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'image_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'is_quantity_check'=>['type'=>Form::INPUT_RADIO_LIST, 'items'=>[1=>'是', 0=>'否'],
                                'label'=>"<span style = 'color:red'><big>*</big></span>是否需要质检",
                ],
        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 3 column layout
            'pd_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declared_value'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>''],],
            'hs_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>''],],
            'pd_costprice_code'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>''],'staticValue'=>'RMB'],
            'currency_code'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>''],'staticValue'=>'USD'],
            'contain_battery'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'是', 0=>'否'],
                'label'=>"<span style = 'color:red'><big>*</big></span>是否包含电池",
            ],
            'vendor_code'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],
        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>2.尺寸重量</h3></legend>',
        'attributes'=>[       // 3 column layout
            'pd_length'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_width'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_height'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],
    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 3 column layout

            'ctn_length'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'ctn_width'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'ctn_height'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'ctn_fact_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'qty_of_ctn'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);
?>
    <?php echo $form->field($model, 'sale_company')->widget(Select2::classname(), [
        'data' => [
            '2'=>'商舟',
            '3'=>'雅耶',
            '5'=>'朗探',
            '6'=>'域聪',
            '7'=>'鹏侯',
            '8'=>'客尊',
            '9'=>'朵邦',
        ],
        'options' => ['placeholder' => '选择销售公司.....'],
        'pluginOptions' => [
            'multiple' => true,
            'allowClear' => true
        ],
    ]);?>

    <?php
    echo Form::widget([
        'model'=>$sku_vendor,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>3.供应商信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'vendor_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'origin_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'bill_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'bill_unit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],


        ],

    ]);
    echo Form::widget([
        'model'=>$sku_vendor,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 6 column layout
            'min_order_num'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_get_days'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_costprice_code'=>['type'=>Form::INPUT_STATIC, 'staticValue'=>'RMB'],
            'brand'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],

    ]);
    ?>

<?php

     echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
         'contentBefore'=>'<legend class="text-info"><h3>4.备注信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'sku_mark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

        ],

    ]);

    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*Yii2给必填项加星，样式如下：*/

/*css input弧度*/
$this->registerJs("
        $(function () {
            $('.form-control').css('border-radius','7px')
        }); 
        ", \yii\web\View::POS_END);

$JS =<<<JS
    $(function(){
        var  requirelabels =[
           "goodssku-hs_code","goodssku-pd_title","goodssku-pd_title_en","goodssku-image_url","goodssku-pd_costprice","goodssku-pd_costprice_code",
            "goodssku-vendor_code","goodssku-declared_value","goodssku-currency_code","goodssku-pd_length","goodssku-pd_width",
            "goodssku-pd_height","goodssku-pd_weight","goodssku-sale_company" ,"skuvendor-vendor_code","skuvendor-bill_name",
            "skuvendor-bill_unit","skuvendor-pd_costprice","skuvendor-min_order_num","skuvendor-pd_get_days","skuvendor-origin_code"];
        var label;
       $("label[for='goodssku-sku']").addClass("label-require");
       for ( label in requirelabels){
               $("label[for='"+requirelabels[label]+"']").addClass("label-require");
       } 
        $('.label-require').html(function (_,html){
                return html.replace(/(.*?)/,"<span style='color:red'><big>*$1</big></span>")
        });
    });

JS;

$this->registerJs($JS);


?>