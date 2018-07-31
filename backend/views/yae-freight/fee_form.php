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
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'showPageSummary'=>false,
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
            'attribute'=>'name_zn',
            'width'=>'310px',

        ],
        [
            'attribute'=>'quantity',
            'width'=>'100px',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->quantity;
            },
//            'pageSummary'=>true,


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
                }elseif ($model->currency==5){
                    return 'RMB';
                }

            },

        ],
        [
            'attribute'=>'amount',
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


