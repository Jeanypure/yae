<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/6/12
 * Time: 上午10:41
 */
use yii\helpers\Html;
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
        'attributes'=>[       // 3 column layout
            'is_quality'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>样品质量是否合格?",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'is_purchase'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>是否采购?",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'sample_return'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>是否需要退样品?",
                'items'=>[1=>'是', 0=>'否',2=>'不确定'],
                'options'=>['placeholder'=>'',]
            ],

        ],

    ]);

    echo $form->field($sample_model, 'minister_result')->widget(Select2::classname(), [
        'data' => [
            '1'=>'半价产品',
            '2'=>'新品',
            '3'=>'推送产品',
            '4'=>'简单重复',
            '5'=>'不算提成',
        ],
        'options' => ['placeholder' => '产品等级','label'=>"<span style = 'color:red'><big>*</big></span>部长判断",],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]);
    echo $form->field($sample_model,'minister_reason')->textarea();
    ?>





    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>


    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
$require_js =<<<JS
    $(function() {
        $("label[for='sample-minister_result'] ").addClass("label-require");
        $('.label-require').html(function(_,html) {
            return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
        });
      
    });
    
JS;



$this->registerJs($require_js);
?>