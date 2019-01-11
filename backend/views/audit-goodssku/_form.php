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
            'sku'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'old_sku'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'image_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'hs_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>''],],
            'is_quantity_check'=>['type'=>Form::INPUT_RADIO_LIST, 'items'=>[1=>'是', 0=>'否'],
                'label'=>"<span style = 'color:red'><big>*</big></span>是否需要质检",],



        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 3 column layout
            'pd_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_costprice_code'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>''],'staticValue'=>'RMB'],
            'vendor_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declared_value'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>''],],
            'currency_code'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>''],'staticValue'=>'USD'],

            'contain_battery'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'是', 0=>'否'],
                'label'=>"<span style = 'color:red'><big>*</big></span>是否包含电池",],
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
            'material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'use'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
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
    echo $form->field($model, 'sale_company')->widget(Select2::classname(), [
        'data' => [
            '2'=>'商舟',
            '3'=>'雅耶',
            '5'=>'朗探',
            '6'=>'域聪',
            '7'=>'鹏侯',
            '8'=>'客尊',
            '9'=>'朵邦',
            '13'=>'杭州雅耶',
        ],
        'options' => ['placeholder' => '选择销售公司.....'],
        'pluginOptions' => [
            'multiple' => true,
            'allowClear' => true
        ],
    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
         'contentBefore'=>'<legend class="text-info"><h3>3.备注信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'sku_mark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

        ],

    ]);
    ?>
    <?php

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'contentBefore'=>'<legend class="text-info"><h3>4.要素信息</h3></legend>',
        'attributes'=>[       // 6 column layout
            'declaration_item_key1'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declaration_item_key2'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value2'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declaration_item_key3'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value3'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[       // 6 column layout
            'declaration_item_key4'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value4'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declaration_item_key5'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value5'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declaration_item_key6'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value6'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[       // 6 column layout
            'declaration_item_key7'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value7'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declaration_item_key8'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value8'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'declaration_item_key9'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'declaration_item_value9'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],
    ]);

    ?>


    <div class="form-group">
        <?php
//        echo  Html::submitButton('Save', ['class' => 'btn btn-success btn-lg']) ?>
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
            "goodssku-declaration_item_value1", "goodssku-declaration_item_value2", "goodssku-declaration_item_value3", "goodssku-declaration_item_value4", "goodssku-declaration_item_value5",
            "goodssku-pd_height","goodssku-pd_weight","goodssku-sale_company" ,"skuvendor-vendor_code","skuvendor-bill_name",
            "goodssku-material","goodssku-use",
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