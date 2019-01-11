<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '自主开发--分部: ' . $model->pur_info_id, [
    'nameAttribute' => '' . $model->pur_info_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pur_info_id, 'url' => ['view', 'id' => $model->pur_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pur-info-update">
    <img src="<?php echo  $model->pd_pic_url ?>" alt="" width="100px" height="100px" >

    <div class="pur-info-form">
        <?php
        $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
        ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
        <?php
        echo '<legend class="text-info"><h3>1.基本信息</h3></legend>';
        echo $form->field($model, 'pur_group')->widget(Select2::classname(), [
        'data' => [
           /* '1'=>'商舟',
            '2'=>'雅耶',
            '3'=>'朗探',
            '4'=>'域聪',
            '5'=>'鹏侯',
            '6'=>'客尊',
            '7'=>'朵邦',
            '8'=>'日本',*/
            '1'=>'1',
            '2'=>'2',
            '3'=>'3',
            '4'=>'4',
//            '5'=>'5',
            '6'=>'6',
            '7'=>'7',
            '8'=>'8',
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
            'columns'=>4,
//            'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
            'attributes'=>[       // 3 column layout
//                   'pur_group'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_title'=>['type'=>Form::INPUT_TEXT,
                    'labelOptions'=>['class'=>'label-require'],
                    'options'=>['placeholder'=>'','class'=>'label-require']],
                'pd_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_pic_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'地址格式:https://XXXX.jpg|png|gif等']],
                'source'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'0销售推荐 1自主开发']],
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


        ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>





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

            
            $('.label-require').html(function(_,html) {
                return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
            });
            
            
            // purinfo-source
           var source =  $('#purinfo-source').val();
           if (source == 0){
               $("#purinfo-pur_group").attr("readonly","readonly");
           } 
        });
        
JS;
$this->registerJs($readonly_js);
?>



