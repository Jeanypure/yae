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
                ]
            )
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
        ['class'=>'kartik\grid\ActionColumn',
          'template' => '{view} {update} {delete}',
            'buttons' => [
                'update' => function($url, $model, $key){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => '编辑费用',
                        'data-toggle' => 'modal',
                        'data-target' => '#audit-modal',
                        'class' => 'data-audit',
                        'data-id' => $key,
                    ] );
                },
                'delete' => function($url, $model, $key){
                    return Html::a('' ,['/yae-freight/fee-delete/', 'id' => $model->id], [
                        'class' => 'glyphicon glyphicon-trash deleteLink',

                    ]);
                },
            ],

        ],
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
    ],
]);
ActiveForm::end();
?>



<?php
use yii\bootstrap\Modal;
Modal::begin([
    'id' => 'fee-add-modal',
    'header' => '<h4 class="modal-title">添加费用</h4>',
    'footer' =>  '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);

$add_fee = Url::toRoute('create-fee');
$freight_id= $model->id;
$js = <<<JS
$(".fee-modaldialog").click(function(){ 
     
        $.get('{$add_fee}',{ id: $freight_id }, 
                function (data) {
                    $('.modal-body').html(data);
                }  
            );
   }); 
JS;
$this->registerJs($js);

Modal::end();
?>


<?php
// 费用编辑
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">编辑费用</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
    'options'=>[
        'data-backdrop'=>'static',//点击空白处不关闭弹窗
        'data-keyboard'=>false,
    ],
    'size'=> Modal::SIZE_LARGE
]);
Modal::end();
?>
<?php
$edit_fee = Url::toRoute('update-fee');
$auditJs = <<<JS
        $('.data-audit').on('click', function () {
            $.get('{$edit_fee}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    $('.modal-body').html(data);
                }  
            );
        });
JS;
$this->registerJs($auditJs);

?>

<?php
$delurl = Url::toRoute('/yae-freight/fee-delete/');
 $del_fee = <<<JS
         $(function () {
         $('#sku-table').hide();
        $('.deleteLink').click(function () {
            var tThis =$(this);
            if (confirm("确定要删除这条费用吗？")){
                $.get('{$delurl}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    if (data == 1){
                        $(tThis).parent().parent().remove();
                        alert('删除成功')
                    }else{
                        alert('删除失败')
                    }
                })
            }
            return false;
        })
    })
JS;
 $this->registerJs($del_fee);
?>


