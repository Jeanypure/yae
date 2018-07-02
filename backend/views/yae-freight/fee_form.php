<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/6/30
 * Time: 11:18
 */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
//use kartik\builder\Form;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\FeeCategory;
use backend\models\YaeExchangeRate;
?>
<?php $skuForm = ActiveForm::begin(['id' => 'sku-info', 'method' => 'post',]);
?>
<?php

echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'id' => 'sku-table',
    'form' => $skuForm,
    'actionColumn' => [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{delete}',
        'buttons' => [
            'delete' => function ($url, $model, $key) {
                $delete_url = Url::to(['/goodssku/delete','id' => $key]);
                $options = [
                    'title' => '删除',
                    'aria-label' => '删除',
                    'data-id' => $key,
                ];
                return Html::a('<span  class="glyphicon glyphicon-trash"></span>', $delete_url, $options);
            },
            'width' => '60px'
        ],
    ],
    'attributes' => [

        'freight_id' => ['label' => 'freight_id', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'freight_id'],
        ],
        'description_id' => ['label' => 'Description', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'description_id'],

        ],
        'quantity' => ['label' => 'Quantity', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'quantity']
        ],
        'unit_price' => ['label' => 'Unit Price', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'unit_price']
        ],
        'currency' => ['label' => 'Cur', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'currency'],
        ],
        'amount' => ['label' => 'Amount', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'amount']],
        'remark' => ['label' => 'Ramark', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'remark'],
        ],


    ],

]);

ActiveForm::end();
?>

<?php
echo GridView::widget([
    'dataProvider'=>$dataProvider,
//    'filterModel'=>$searchModel,
    'showPageSummary'=>true,
    'pjax'=>true,
    'toolbar' =>  [
        ['content' =>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Fee'), 'class' => 'btn btn-success fee-modaldialog',
                'data-toggle'=>"modal" ,'data-target'=>"#fee-add-modal"
//                'data-toggle'=>"modal" ,'data-target'=>"#Mymodal"
                ]
            ) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
        ],
//        '{export}',
//        '{toggleData}',
    ],
    'striped'=>true,
    'hover'=>true,
    'responsive'=>true,
    'panel'=>['type'=>'primary', 'heading'=>'Grid Grouping Example'],
    'columns'=>[
        ['class'=>'kartik\grid\SerialColumn'],
        ['class'=>'kartik\grid\ActionColumn'],
        [
            'attribute'=>'description_id',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) {
                if($model->description_id==1){
                    return '海运费' ;
                }elseif ($model->description_id==2){
                    return '关税' ;
                }elseif ($model->description_id==3){
                    return '车架费' ;
                }elseif ($model->description_id==4){
                    return '预提费' ;
                }elseif ($model->description_id==5){
                    return '国外仓租' ;
                }elseif ($model->description_id==6){
                    return '滞箱费' ;
                }elseif ($model->description_id==7){
                    return '超时等候费' ;
                }elseif ($model->description_id==8){
                    return '周末送货费' ;
                }elseif ($model->description_id==9){
                    return '落箱费' ;
                }elseif ($model->description_id==10){
                    return '超重许可' ;
                }elseif ($model->description_id==11){
                    return '其他费用' ;
                }else{
                    return '其他' ;
                }

            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(FeeCategory::find()->orderBy('id')->asArray()->all(), 'id', 'name_zn'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any supplier'],
            'group'=>true,  // enable grouping
            'pageSummary'=>'Page Summary',
        ],
        [
            'attribute'=>'quantity',
            'width'=>'100px',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->quantity;
            },
            'pageSummary'=>true,


        ],

        [
            'attribute'=>'unit_price',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],

        ],
        [
            'attribute'=>'currency',
            'width'=>'100px',

            'value'=>function ($model, $key, $index, $widget) {
                if($model->currency==1){
                    return 'USD';
                }elseif ($model->currency==2){
                    return 'GBP';
                }elseif ($model->currency==3){
                    return 'CAD';
                }elseif ($model->currency==4){
                    return 'EUR';
                }

            },

        ],
        [
            'attribute'=>'amount',

            'pageSummary'=>true,
            'pageSummaryOptions'=>['class'=>'text-left text-warning'],
        ],
        [
            'attribute'=>'remark',
            'width'=>'100px',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->remark;
            },

        ],
//        [
//            'attribute'=>'units_in_stock',
//            'width'=>'150px',
//            'hAlign'=>'right',
//            'format'=>['decimal', 0],
//            'pageSummary'=>true
//        ],
//        [
//            'class'=>'kartik\grid\FormulaColumn',
//            'header'=>'Amount In Stock',
//            'value'=>function ($model, $key, $index, $widget) {
//                $p = compact('model', 'key', 'index');
//                return $widget->col(4, $p) * $widget->col(5, $p);
//            },
//            'mergeHeader'=>true,
//            'width'=>'150px',
//            'hAlign'=>'right',
//            'format'=>['decimal', 2],
//            'pageSummary'=>true
//        ],
    ],
]);

?>

<?php
echo GridView::widget([
    'moduleId' => 'gridviewKrajee', // change the module identifier to use the respective module's settings
    'dataProvider' => $dataProvider,
//    'columns' => $columns,
    // other widget settings
    'responsive'=>true,
    'hover'=>true
]);


?>



<?php
//editable

// the grid columns setup (only two column entries are shown here
// you can add more column entries you need for your use case)
$gridColumns = [
    ['class'=>'kartik\grid\SerialColumn'],
    ['class'=>'kartik\grid\ActionColumn'],

// the name column configuration
    [
//        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'description_id',
        'value'=>function ($model, $key, $index, $widget) {
            if($model->description_id==1){
                return '海运费' ;
            }elseif ($model->description_id==2){
                return '关税' ;
            }elseif ($model->description_id==3){
                return '车架费' ;
            }elseif ($model->description_id==4){
                return '预提费' ;
            }elseif ($model->description_id==5){
                return '国外仓租' ;
            }elseif ($model->description_id==6){
                return '滞箱费' ;
            }elseif ($model->description_id==7){
                return '超时等候费' ;
            }elseif ($model->description_id==8){
                return '周末送货费' ;
            }elseif ($model->description_id==9){
                return '落箱费' ;
            }elseif ($model->description_id==10){
                return '超重许可' ;
            }elseif ($model->description_id==11){
                return '其他费用' ;
            }else{
                return '其他' ;
            }

        },
//        'editableOptions'=>[
//            'header'=>'quantity',
//            'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
//            'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
//        ],
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'width'=>'100px',
//        'format'=>['decimal', 2],
        'pageSummary'=>true
    ],

// the quantity column configuration
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'quantity',
        'editableOptions'=>[
            'header'=>'quantity',
            'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
            'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
        ],
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'width'=>'100px',
        'format'=>['decimal', 2],
        'pageSummary'=>true
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'unit_price',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Name',
                'size'=>'md',
                'afterInput'=>function ($form, $widget) use ($model, $index) {
                    return $form->field($model, "quantity")->widget(\kartik\widgets\ColorInput::classname(), [
                        'showDefaultPalette'=>false,
                        'options'=>['id'=>"color-{$index}"],
                        'pluginOptions'=>[
                            'showPalette'=>true,
                            'showPaletteOnly'=>true,
                            'showSelectionPalette'=>true,
                            'showAlpha'=>false,
                            'allowEmpty'=>false,
                            'preferredFormat'=>'name',
                            'palette'=>[
                                ["white", "black", "grey", "silver", "gold", "brown"],
                                ["red", "orange", "yellow", "indigo", "maroon", "pink"],
                                ["blue", "green", "violet", "cyan", "magenta", "purple"],
                            ]
                        ],
                    ]);
                }
            ];
        }
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'currency',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Name',
                'size'=>'md',
                'afterInput'=>function ($form, $widget) use ($model, $index) {
                    return $form->field($model, "quantity")->widget(\kartik\widgets\ColorInput::classname(), [
                        'showDefaultPalette'=>false,
                        'options'=>['id'=>"color-{$index}"],
                        'pluginOptions'=>[
                            'showPalette'=>true,
                            'showPaletteOnly'=>true,
                            'showSelectionPalette'=>true,
                            'showAlpha'=>false,
                            'allowEmpty'=>false,
                            'preferredFormat'=>'name',
                            'palette'=>[
                                ["white", "black", "grey", "silver", "gold", "brown"],
                                ["red", "orange", "yellow", "indigo", "maroon", "pink"],
                                ["blue", "green", "violet", "cyan", "magenta", "purple"],
                            ]
                        ],
                    ]);
                }
            ];
        }
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'currency',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Name',
                'size'=>'md',
                'afterInput'=>function ($form, $widget) use ($model, $index) {
                    return $form->field($model, "quantity")->widget(\kartik\widgets\ColorInput::classname(), [
                        'showDefaultPalette'=>false,
                        'options'=>['id'=>"color-{$index}"],
                        'pluginOptions'=>[
                            'showPalette'=>true,
                            'showPaletteOnly'=>true,
                            'showSelectionPalette'=>true,
                            'showAlpha'=>false,
                            'allowEmpty'=>false,
                            'preferredFormat'=>'name',
                            'palette'=>[
                                ["white", "black", "grey", "silver", "gold", "brown"],
                                ["red", "orange", "yellow", "indigo", "maroon", "pink"],
                                ["blue", "green", "violet", "cyan", "magenta", "purple"],
                            ]
                        ],
                    ]);
                }
            ];
        }
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'amount',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Name',
                'size'=>'md',
                'afterInput'=>function ($form, $widget) use ($model, $index) {
                    return $form->field($model, "quantity")->widget(\kartik\widgets\ColorInput::classname(), [
                        'showDefaultPalette'=>false,
                        'options'=>['id'=>"color-{$index}"],
                        'pluginOptions'=>[
                            'showPalette'=>true,
                            'showPaletteOnly'=>true,
                            'showSelectionPalette'=>true,
                            'showAlpha'=>false,
                            'allowEmpty'=>false,
                            'preferredFormat'=>'name',
                            'palette'=>[
                                ["white", "black", "grey", "silver", "gold", "brown"],
                                ["red", "orange", "yellow", "indigo", "maroon", "pink"],
                                ["blue", "green", "violet", "cyan", "magenta", "purple"],
                            ]
                        ],
                    ]);
                }
            ];
        }
    ],

];
    // the GridView widget (you must use kartik\grid\GridView)
    echo \kartik\grid\GridView::widget([
        'dataProvider'=>$dataProvider,
//        'filterModel'=>$searchModel,
        'columns'=>$gridColumns
    ]);
?>




<?php
use yii\bootstrap\Modal;
Modal::begin([
    'id' => 'fee-add-modal',
    'header' => '<h4 class="modal-title">添加费用hhh</h4>',
    'footer' =>  '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);

//$add_fee = Url::toRoute('/freight-fee/create');
$add_fee = Url::toRoute('create-fee');
$freight_id= $model->id;
$js = <<<JS
$(".fee-modaldialog").click(function(){ 
        // aUrl = $(this).attr('data-url');
        // aTitle = $(this).attr('data-title');
        // console.log(aTitle);
        // console.log(aUrl);
        //
        // $($(this).attr('data-target')+" .modal-title").text(aTitle);
        // $($(this).attr('data-target')).modal("show")
        //      .find(".modal-body")
        //      .load(aUrl); 
        // return false;
        
        $.get('{$add_fee}',
         // { id: $(this).closest('tr').data('key') },
         { id: $freight_id }, 
                function (data) {
                    $('.modal-body').html(data);
                }  
            );
   }); 
JS;
$this->registerJs($js);

Modal::end();
?>
