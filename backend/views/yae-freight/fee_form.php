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
use kartik\builder\Form;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\FeeCategory;
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
        'ramark' => ['label' => 'Ramark', 'type' => TabularForm::INPUT_TEXT,
            'options' => ['class' => 'ramark'],
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
    'striped'=>true,
    'hover'=>true,
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
                return $model->currency;
            },

        ],
        [
            'attribute'=>'amount',

            'pageSummary'=>true,
            'pageSummaryOptions'=>['class'=>'text-left text-warning'],
        ],
        [
            'attribute'=>'ramark',
            'width'=>'100px',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->ramark;
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