<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;




/* @var $this yii\web\View */
/* @var $model_preview backend\models\Preview */

$this->title = Yii::t('app', 'Create Preview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preview-create">

    <?= $this->render('view', [
        'model' => $purinfo,


    ]) ?>
    <div class="preview-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model_preview, 'member')->textInput(['maxlength' => true])
            ->hiddenInput(['value'=>Yii::$app->user->identity->username])->label(false); ?>

        <?= $form->field($model_preview, 'product_id')->textInput(['value' => $id ])
        ->hiddenInput(['value'=>$id])->label(false);?>

        <?= $form->field($model_preview, 'priview_time')->textInput()
            ->hiddenInput([])->label(false) ?>

        <?= $form->field($model_preview, 'member_id')->textInput()
            ->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>



        <?php
        echo Form::widget([
            'model'=>$model_preview,
            'form'=>$form,
            'columns'=>2,
            'contentBefore'=>'<legend class="text-info"><h3>评审数据记录</h3></legend>',
            'attributes'=>[       // 2 column layout
                'ref_url1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ref_url2'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);

        echo Form::widget([
            'model'=>$model_preview,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[       // 2 column layout
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


