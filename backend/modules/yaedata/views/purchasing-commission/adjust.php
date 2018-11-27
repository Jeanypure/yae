<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/10
 * Time: 10:13
 */
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;


$this->title = Yii::t('app', '产品等级调整: {nameAttribute}', [
    'nameAttribute' => "$info->pd_title"
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '产品'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->spur_info_id, 'url' => ['view', 'id' => $model->spur_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', '产品等级调整');

?>

<div class="sample-form">

<p>
    <img src="<?php echo  $info->pd_pic_url ?>" alt="" style="width: 100px; height: 100px">
</p>
    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-sm-3">
            <?php
        // Usage with ActiveForm and model
        echo $form->field($model, 'minister_result')->widget(Select2::classname(), [
            'data' => [
                '1'=>'半价产品',
                '2'=>'新品',
                '3'=>'推送产品',
                '4'=>'简单重复',
                '5'=>'不算提成',
            ],
            'options' => ['placeholder' => '产品等级'],
            'pluginOptions' => [
                'allowClear' => true
            ],

        ]);
        ?>
        </div>
        <div class ="col-sm-3">
            <?php
        // Usage with ActiveForm and model
        echo $form->field($model, 'purchaser_result')->widget(Select2::classname(), [
            'data' => [
                '1'=>'半价产品',
                '2'=>'新品',
                '3'=>'推送产品',
                '4'=>'简单重复',
                '5'=>'不算提成',
            ],
            'options' => ['placeholder' => '产品等级'],
            'pluginOptions' => [
                'allowClear' => true
            ],

        ]);
        ?>

        </div>
    </div>
    <legend class="text-info"><h2>产品等级调整</h2></legend>
    <div class="row">

        <div class="col-sm-6">
            <?php
            // Usage with ActiveForm and model
            echo $form->field($model, 'audit_team_result')->widget(Select2::classname(), [
                'data' => [
                    '1'=>'半价产品',
                    '2'=>'新品',
                    '3'=>'推送产品',
                    '4'=>'简单重复',
                    '5'=>'不算提成',
                ],
                'options' => ['placeholder' => '产品等级'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]);
            ?>

        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
          <?php
            echo $form->field($model,'audit_team_reason')->textarea();
            ?>
        </div>
        <div class="col-sm-12">
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
