<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;




/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>1.样品费用信息</h3></legend>',
        'attributes'=>[       // 6 column layout
            'procurement_cost'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'sample_freight'=>['type'=>Form::INPUT_TEXT,
                'options'=>['placeholder'=>'','class'=>'label-require']],
            'else_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pay_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'pd_sku'=>['type'=>Form::INPUT_TEXT,
                'options'=>['placeholder'=>'','class'=>'label-require']],
        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[       // 6 column layout

            'pay_way'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'mark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],
        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 6 column layout
            'fee_return'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>能否退样品退样品费?",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'for_free'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"批量采购是否赠送样品(即不退样品只退样品费)?",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'spur_info_id'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],

        ],

    ]);
    echo $form->field($model, 'purchaser_result')->widget(Select2::classname(), [
        'data' => [
            '1'=>'半价产品',
            '2'=>'新品',
            '3'=>'推送产品',
            '4'=>'简单重复',
            '5'=>'不算提成',
            '6'=>'推送且半价=0.25个',
        ],
        'options' => ['placeholder' => '产品等级',  ],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]);
    echo $form->field($model,'purchaser_reason')->textarea();

    ?>


    <div class="form-group">


        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>

    </div>
    <div class="form-group">
        <?php echo Html::button('提交申请',['class' => 'btn btn-info' ,'id'=>'is_submit'])?>
        <?php echo Html::button('取消提交',['class' => 'btn btn-primary' ,'id'=>'un_submit'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $commit = Url::toRoute(['single-commit']);
    $cancel = Url::toRoute(['single-cancel']);
    $js = <<<JS
    $('#is_submit').on('click',function(){
        var  button = $(this);
         button.attr('disabled','disabled');
         var id = $('#sample-spur_info_id').val();
        if(id==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$commit}", 
         type: 'post',
         data:{id:id},
         success:function(res){
           if(res=='success') alert('提交申请成功!');  
            if(res=='error') alert('出错了,检查信息完整在提交'); 
           button.attr('disabled',false);
         },
         error: function (res,jqXHR, textStatus, errorThrown) {
               if(res=='error') alert('出错了,检查信息完整在提交');            
             button.attr('disabled',false);
         }
      
    });
        
    });

    $('#un_submit').on('click',function(){
        var  button = $(this);
         button.attr('disabled','disabled');
         var id = $('#sample-spur_info_id').val();
        if(id==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$cancel}", 
         type: 'post',
         data:{id:id},
         success:function(res){
           if(res=='success') alert('取消申请成功!');     
           button.attr('disabled',false);
           // location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
             button.attr('disabled',false);
         }
      
    });
        
    });

JS;
    $this->registerJs($js);

//css 表单input 变圆润

$this->registerJs("
        $(function () {
            $('.form-control').css('border-radius','6px')
        }); 
        ", \yii\web\View::POS_END);
$readonly_js =<<<JS
        $(function(){
            
            $("#sample-pay_amount").attr("readonly","readonly");
            $("#sample-procurement_cost").attr("readonly","readonly");
            
          
            $("label[for='sample-procurement_cost'] ").addClass("label-require");
            $("label[for='sample-sample_freight'] ").addClass("label-require");
            $("label[for='sample-pay_way'] ").addClass("label-require");
            $("label[for='sample-purchaser_result'] ").addClass("label-require");
            $("label[for='sample-pay_amount'] ").addClass("label-require");
            $("label[for='sample-pd_sku'] ").addClass("label-require");
            
            $('.label-require').html(function(_,html) {
                return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
            });
                
         

        });
        
JS;
$this->registerJs($readonly_js);

//费用计算

$compute_js = <<<JS
         $('#w1').on('change',function() {
            // 付款金额 = 采购成本 + 运费 + 其他费用 
            var pay_amount;
            var procurement_cost  = $('#sample-procurement_cost').val();
            var sample_freight  = $('#sample-sample_freight').val();
            var else_fee  = $('#sample-else_fee').val();
            pay_amount = parseFloat(procurement_cost) + parseFloat(sample_freight)+ parseFloat(else_fee);
                $('#sample-pay_amount').val(pay_amount)
         });
JS;

$this->registerJs($compute_js);

?>

