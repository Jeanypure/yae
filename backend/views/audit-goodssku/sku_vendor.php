<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/4
 * Time: 10:46
 */


use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SkuVendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="sku-vendor-index">

    <legend class="text-info"><h3>4.供应商信息</h3></legend>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'toolbar' =>  [
            ['content' =>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Fee'), 'class' => 'btn btn-success fee-modaldialog',
                        'data-toggle'=>"modal" ,'data-target'=>"#fee-add-modal"
                    ]
                )

            ],
        ],

        'striped'=>true,
        'hover'=>true,
        'responsive'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'供应商列表'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vendor_code',
            'origin_code',
            'min_order_num',
            'pd_get_days',
            'pd_costprice_code',
            'pd_costprice',
            'bill_name',
            'bill_unit',
            'brand',
            'create_date',
            'update_date',
            'remark',

            [
                'class' => 'yii\grid\ActionColumn',
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
        ],
    ]); ?>


</div>

<?php
use yii\bootstrap\Modal;
Modal::begin([
    'id' => 'fee-add-modal',
    'header' => '<h4 class="modal-title">添加供应商</h4>',
    'footer' =>  '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
    'size'=> Modal::SIZE_LARGE
]);

$add_vendor = Url::toRoute('vendor-create');
$sku_id= $model->sku_id;
$js = <<<JS
$(".fee-modaldialog").click(function(){ 
     
        $.get('{$add_vendor}',{ id: $sku_id }, 
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
    'header' => '<h4 class="modal-title">编辑供应商</h4>',
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
$edit_fee = Url::toRoute('vendor-update');
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
$delurl = Url::toRoute('/goodssku/vendor-delete/');
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


