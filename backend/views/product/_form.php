<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
            echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
                'attributes'=>[       // 3 column layout
                    'product_title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'product_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'product_purchase_value'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'pd_pic_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'地址格式:https://XXXX.jpg|png|gif等']],

                ],

            ]);
            echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'contentBefore'=>'<legend class="text-info"><h3>2.链接信息</h3></legend>',
                'attributes'=>[       // 3 column layout

                    'ref_url1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'ref_url2'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'ref_url3'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                    'ref_url4'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                ],

            ]);

    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success ']) ?>

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

//span * 必填字段

$require_js = <<<JS
    $(function(){
         $("label[for='product-product_title'] ").addClass("label-require");
         $("label[for='product-product_title_en'] ").addClass("label-require");
         $("label[for='product-pd_pic_url'] ").addClass("label-require");
            
            $('.label-require').html(function(_,html) {
                return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
            });
    });
JS;

$this->registerJs($require_js);




?>


