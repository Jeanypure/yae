<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/6
 * Time: 14:46
 */
use yii\helpers\Html;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;


$this->title = Yii::t('app', '部长审批: {nameAttribute}', [
    'nameAttribute' => "$info->pd_title"
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '产品'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->spur_info_id, 'url' => ['view', 'id' => $model->spur_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', '确认到货');

?>

<div class="sample-form">
    
<p>
    <img src="<?php echo  $info->pd_pic_url ?>" alt="" style="width: 100px; height: 100px">
</p>
    <?php $form = ActiveForm::begin(); ?>

    <legend class="text-info"><h2>到货审核记录</h2></legend>

    <div class="row">
        <div class="col-sm-3">
            <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'has_arrival')->widget(Select2::classname(), [
                'data' => [
                    '1'=>'已到货',
                    '0'=>'未到',
                ],
                'options' => ['placeholder' => '是否到货?',],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo '<label>到货日期</label>';
            echo DatePicker::widget([
                'name' => 'write_date',
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>

        </div>
        <div class="col-sm-3">
            <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'minister_result')->widget(Select2::classname(), [
                'data' => [
                    '1'=>'半价产品',
                    '2'=>'新品',
                    '3'=>'推送产品',
                    '4'=>'简单重复',

                ],
                'options' => ['placeholder' => '部长判断','label'=>"<span style = 'color:red'><big>*</big></span>部长判断",],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]);
            ?>
        </div>


    </div>

    <div class="row">
        <div class="col-sm-3">
            <?php
            echo $form->field($model,'minister_reason')->textarea();
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            echo $form->field($model,'spur_info_id')->hiddenInput()->label(false);
            ?>
        </div>

    </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>

        </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
 $rm_js = <<<JS
    $(function() {
        $('h3').remove();
      
    })
JS;

 $this->registerJs($rm_js);

?>
