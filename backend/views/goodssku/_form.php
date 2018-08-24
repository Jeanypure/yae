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
            'sku'=>['type'=>Form::INPUT_TEXT, 'options'=>['class'=>'required '],'labelSpan'=>1],
            'old_sku'=>['type'=>Form::INPUT_TEXT, 'labelOptions'=>['class'=>'required'],'labelSpan'=>'***'],
            'pd_title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'image_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'is_quantity_check'=>['type'=>Form::INPUT_RADIO_LIST, 'items'=>[1=>'是', 0=>'否'],'options'=>['placeholder'=>'']],



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

            'contain_battery'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'是', 0=>'否'], 'options'=>['placeholder'=>'']],
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
    /*echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>3.供应商信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'vendor_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'origin_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'min_order_num'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_get_days'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 6 column layout
            'pd_costprice_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'bill_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'bill_unit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'brand'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
        ],

    ]);*/


     echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
         'contentBefore'=>'<legend class="text-info"><h3>3.备注信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'sku_mark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

        ],

    ]);

    echo $form->field($model, 'sale_company')->widget(Select2::classname(), [
        'data' => [
            '商舟'=>'商舟',
            '雅耶'=>'雅耶',
            '朗探'=>'朗探',
            '域聪'=>'域聪',
            '朋侯'=>'朋侯',
            '客尊'=>'客尊',
        ],
        'options' => ['placeholder' => '选择销售公司.....'],
        'pluginOptions' => [
            'multiple' => true,
            'allowClear' => true
        ],
    ]);
   /* echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[       // 3 column layout
            'sale_company'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);*/
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
        var  requirelabels = new Array(
            "goodssku-pd_title","goodssku-pd_title_en","goodssku-image_url","goodssku-pd_costprice","goodssku-pd_costprice_code",
            "goodssku-vendor_code","goodssku-declared_value","goodssku-currency_code","goodssku-pd_length","goodssku-pd_width",
            "goodssku-pd_height","goodssku-pd_weight","goodssku-sale_company"
        );
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