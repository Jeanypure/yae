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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php
use yii\bootstrap\Modal;
Modal::begin([
    'id' => 'fee-add-modal',
    'header' => '<h4 class="modal-title">添加供应商</h4>',
    'footer' =>  '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);

$add_fee = Url::toRoute('vendor-create');
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

