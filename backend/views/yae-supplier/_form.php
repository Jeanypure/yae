<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yae-supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>1.供应商基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'supplier_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'supplier_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'credit_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'supplier_address'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'origin_product_source'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);
    ?>
    <div class="row">
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'sale_company')->widget(Select2::classname(), [
                'data' => [
                    '2'=>'商舟',
                    '3'=>'雅耶',
                    '5'=>'朗探',
                    '6'=>'域聪',
                    '7'=>'朋侯',
                    '8'=>'客尊',
//                    '9'=>'朵邦',
                ],
                'options' => ['placeholder' => '选择销售公司'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>4,
                'attributes'=>[       // 3 column layout
                    'has_cooperate'=>['type'=>Form::INPUT_RADIO_LIST,
                        'items'=>[1=>'是', 0=>'否'],
                        'label'=>"<span style = 'color:red'><big>*</big></span>是否合作过",
                        'options'=>['placeholder'=>'']],
                ],

            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'business_licence')->widget('manks\FileInput', []);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo   $form->field($model, 'bl_img_address');
            ?>
        </div>

    </div>
    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>2.开票基本信息</h3></legend>',

        'attributes'=>[       // 3 column layout
            'pd_bill_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'bill_unit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'bill_type'=>['type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>开票类型",
                'items'=>['0'=>'13%专票','1'=>'增值税普通普票', '2'=>'3%专票'],
                ],
        ],

    ]);
    ?>


    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>3.相关银行信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'pay_card'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pay_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pay_bank'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'account_proportion'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);
    ?>
    <div class="row">
        <div class="col-sm-3">
            <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'pay_cycleTime_type')->widget(Select2::classname(), [
                'data' => [
                    '1'=>'日结',
                    '2'=>'周结',
                    '3'=>'半月结',
                    '4'=>'月结',
                    '5'=>'隔月结',
//                    '6'=>'其他',
                ],
                'options' => ['placeholder' => '支付周期.....'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>
        <!--    1、货到付款。2、款到发货。3、周期结算。4、售后付款。5、默认方式-->
        <div class="col-sm-3">
            <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'account_type')->widget(Select2::classname(), [
                'data' => [
                    '1'=>'货到付款',
                    '2'=>'款到发货',
                    '3'=>'周期结算',
                    '4'=>'售后付款',
                    '5'=>'默认方式',
//                    '6'=>'其他',
                ],
                'options' => ['placeholder' => '供应商结算方式.....'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>
        <div class="col-sm-3">
            <?php
            echo $form->field($model, 'bank_account_data')->widget('manks\FileInput', []);
            ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'bank_img_add') ?>
        </div>
    </div>
   <!-- <fieldset id="w5">
    <legend class="text-info"><h3>4.发票相关</h3></legend>
    <div class="col-sm-3">

        <?php
/*        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'attributes'=>[       // 3 column layout
                'bill_img1_name_unit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ],

        ]);
        */?>
    </div>
    <div class="col-sm-3">
        <?php
/*        echo $form->field($model, 'bill_img1')->widget('manks\FileInput', []);
        */?>
    </div>
    <div class="col-sm-3">
       <?php
/*       echo  $form->field($model, 'bill01_img_add') ;
       */?>
    </div>
</fieldset>-->
    <?php
    echo Form::widget([
        'model'=>$supplier_contact,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>5.供应商联系人基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'contact_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_tel'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_address'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_qq'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);
    echo Form::widget([
        'model'=>$supplier_contact,
        'form'=>$form,
        'columns'=>4,
        'attributes'=>[       // 3 column layout
            'contact_wechat'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_wangwang'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'skype'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_memo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

        ],

    ]);

    ?>
<!--  <!--   <div class="row">-->
<!--        <legend style="margin-left: 10px" class="text-info"><h3>6.供应商接受付款方式</h3></legend>'-->
<!--        <div class="col-sm-3">-->
<!--            --><?php
///*            // Usage with ActiveForm and model
//            echo $form->field($model, 'supplier_pay_methon')->widget(Select2::classname(), [
//                'data' => [
//                    '1'=>'票到付款',
//                    '2'=>'先预付再开票最后付尾款',
//                    '3'=>'先款后票',
//
//                ],
//                'options' => ['placeholder' => '供应商接受付款方式.....'],
//                'pluginOptions' => [
//                    'allowClear' => true
//                ],
//            ]);
//            */?>
<!---->
<!--        </div>-->
<!---->
<!--        <div class="col-sm-3">-->
<!--            --><?php
///*            // Usage with ActiveForm and model
//            echo '<label class="control-label">承诺票到日期</label>';
//            echo DateTimePicker::widget([
//                'name'=>'commitment_date',
//            ])
//            */?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="row">-->
<!--        <div class="col-sm-3">-->
<!--            --><?php
///*            echo Form::widget([
//                'model'=>$model,
//                'form'=>$form,
//                'columns'=>4,
//                'attributes'=>[       // 3 column layout
//                    'bill_img2_name_unit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
//                ],
//
//            ]);
//            */?>
<!--        </div>-->
<!--        <div class="col-sm-3">-->
<!--            --><?php
///*            echo $form->field($model, 'bill_img2')->widget('manks\FileInput', []);
//            */?>
<!--        </div>-->
<!--        <div class="col-sm-3">-->
<!--            --><?php
///*            echo  $form->field($model, 'bill02_img_add') ;
//            */?>
<!---->
<!--        </div>-->
<!---->
<!--    </div>-- -->
    <fieldset id="w6">
    <legend class="text-info"><h3>6.知识产权相关</h3></legend>
    <div class="col-sm-3">
    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'attributes'=>[       // 3 column layout
            'promise_sign_right'=>['type'=>Form::INPUT_RADIO_LIST,
                'items'=>[1=>'是', 0=>'否'],
                'label'=>"<span style = 'color:red'><big>*</big></span>供应商是否答应签署侵犯知识产权责任书",
                'options'=>['placeholder'=>'']],
        ],

    ]);

    ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo $form->field($model, 'sign_right_pic_location')->widget('manks\FileInput', []);
        ?>
    </div>
    </fieldset>

<?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>7.其他注意事項</h3></legend>',
        'attributes'=>[       // 3 column layout
            'sup_remark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

        ],

    ]);
    ?>
    <div class="form-group">
        <?php
        echo Html::submitButton('Save', ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$tupian_address = <<<JS
    $(function(){
        var business_licence,bank_account_data,bill_img1,bill_img2;  //營業執照
        business_licence = $('#yaesupplier-business_licence').val();
        bank_account_data = $('#yaesupplier-bank_account_data').val();
        bill_img1 = $('#yaesupplier-bill_img1').val();
        bill_img2 = $('#yaesupplier-bill_img2').val();
        $('#yaesupplier-bl_img_address').val('http://yaemart.com.cn/'+business_licence);
        $('#yaesupplier-bank_img_add').val('http://yaemart.com.cn/'+bank_account_data);
        $('#yaesupplier-bill01_img_add').val('http://yaemart.com.cn/'+bill_img1);
        $('#yaesupplier-bill02_img_add').val('http://yaemart.com.cn/'+bill_img2);
       
       
    })
JS;
$this->registerJs($tupian_address);

?>

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
        var  requirelabels = [
            'yaesupplier-origin_product_source',
           'yaesupplier-supplier_code','yaesupplier-supplier_name','yaesupplier-supplier_address' ,'yaesupplier-business_licence' ,
           'yaesupplier-pd_bill_name' ,'yaesupplier-bill_unit' ,'yaesupplier-pay_card' ,'yaesupplier-pay_name' ,'yaesupplier-pay_bank' ,'yaesupplier-sale_company',
           'yaesupplier-account_proportion' ,'yaesupplier-pay_cycletime_type' ,'yaesupplier-account_type' ,'yaesupplier-bank_account_data' ,'yaesupplier-supplier_pay_methon',
           'yaesupplier-bill_img1_name_unit','yaesupplier-bill_img1','suppliercontact-contact_name','suppliercontact-contact_address','suppliercontact-contact_tel',
           'suppliercontact-contact_qq','yaesupplier-commitment_date','suppliercontact-contact_wangwang','yaesupplier-credit_code'
        ];
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
