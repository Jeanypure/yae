<?php

use yii\helpers\Html;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisition-detail-form">

    <?php $form = ActiveForm::begin();
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'tranid'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'createdate'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'item_name'=>['type'=>Form::INPUT_STATIC, 'options'=>['placeholder'=>'']],
            'description'=>['type'=>Form::INPUT_STATIC, ],
            'quantity'=>['type'=>Form::INPUT_STATIC],
            'last_price_min'=>['type'=>Form::INPUT_STATIC],
            'after_bargain_price'=>['type'=>Form::INPUT_TEXT],


        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'contentBefore'=>'<legend class="text-info"><h3>2.供应商信息</h3></legend>',
        'attributes'=>[       // 3 column layout
            'povendor_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'supplier_name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_name'=>['type'=>Form::INPUT_TEXT, ],
            'contact_tel'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            'contact_qq'=>['type'=>Form::INPUT_TEXT ],
            'bill_type'=>['type'=>Form::INPUT_DROPDOWN_LIST,
                'items'=>['16%专票'=>'16%专票','增值税普通普票'=>'增值税普通普票', '3%专票'=>'3%专票'],
                'options'=>['placeholder'=>'']],
            'payment_method' => [
                    'type' =>Form::INPUT_DROPDOWN_LIST,
                    'items' =>['','票到付款','先预付再开票再付尾款','先付款后开票']
            ],
            'arrival_date'=>['type'=>Form::INPUT_TEXT],
        ],

    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('保存并提交', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$requiredStar = <<<JS
  $(function(){
    $('.form-control').css('border-radius','7px');
    
    var labelFor = ['requisitiondetail-after_bargain_price','requisitiondetail-povendor_name','requisitiondetail-supplier_name',
                    'requisitiondetail-contact_name','requisitiondetail-contact_tel','requisitiondetail-contact_qq','requisitiondetail-bill_type',
                    'requisitiondetail-payment_method','requisitiondetail-arrival_date'];
    for(var index in labelFor){
    $("label[for='"+labelFor[index]+"']").addClass("label-require");
}
            
    $('.label-require').html(function(_,html) {
        return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
    });
    });

JS;
$this->registerJs($requiredStar);
?>
