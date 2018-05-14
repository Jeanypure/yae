<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '自主开发产品');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-create">
    <div class="pur-info-form">
        <?php
        $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
            'attributes'=>[       // 3 column layout
//                'pur_responsible_id'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'','style'=>'border-radius:7px']],
                'pur_group'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],                'pd_package'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']]

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
                'pd_pic_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
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
                'is_huge'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 2 column layout
                'pd_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_throw_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_count_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ],
            'contentAfter' => '<div ><br> <br></div>'

        ]);



    echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'contentBefore'=>'<legend class="text-info"><h3>3.税费信息</h3></legend>',
             'attributes'=>[       // 2 column layout
                'bill_tax_rebate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'bill_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'no_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 2 column layout
                'shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'oversea_shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'transaction_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);


        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
//            'contentBefore'=>'<legend class="text-info"><h3>其他信息</h3></legend>',

            'attributes'=>[       // 6 column layout
                'pd_purchase_num'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_pur_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'bill_tax_value'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'number little than 16 ...']],
                'hs_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'has_shipping_fee'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'']],

                'bill_type'=>['type'=>Form::INPUT_RADIO_LIST,
                    'items'=>['普票'=>'普票', '专票'=>'专票'],
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
<?php

//css

    $this->registerJs("
    $(function () {
        $('.form-control').css('border-radius','7px')
    });
    ", \yii\web\View::POS_END);


?>
