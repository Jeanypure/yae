<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '产品评审');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">


    <p>
        <?php
//        echo Html::a(Yii::t('app', '创建新品'), ['create'], ['class' => 'btn btn-success']);
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{audit}  {view}  {delete}',
                'buttons' => [
                    'audit' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                            'title' => '评审',
                            'data-toggle' => 'modal',
                            'data-target' => '#audit-modal',
                            'class' => 'data-audit',
                            'data-id' => $key,
                        ] );
                    },
                ],
                'headerOptions' => ['width' => '80'],
            ],

            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                }
            ],
//            'pur_info_id',
            'purchaser',
//            'member',
            'pur_group',
            [
                'attribute'=>'pd_title',
                'value' => function($model) { return $model->pd_title;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'pd_title_en',
                'value' => function($model) { return $model->pd_title_en;},
                'contentOptions'=> ['style' => 'width: 50%; overflow:auto;word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'preview_status',
                'value' => function($model) { return $model->preview_status;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',

            ],
//            'pd_package',
             'preview.member2',
             'preview.view_status',
             'preview.saler_view_status',
            'pd_length',
            'pd_width',
            'pd_height',
            [
                'attribute'=>'is_huge',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->is_huge;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Ishuge'],
                'group'=>true,  // enable grouping
            ],
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
//            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
            'bill_type',
            'bill_tax_value',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            'no_rebate_amount',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ebay_url)) return "<a href='$model->ebay_url' target='_blank'>".parse_url($model->ebay_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->amazon_url)) return "<a href='$model->amazon_url' target='_blank'>".parse_url($model->amazon_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->url_1688)) return "<a href='$model->url_1688' target='_blank'>".parse_url($model->url_1688)['host']."</a>";
                }
            ],
//            'parent_product_id',
//            'shipping_fee',
//            'oversea_shipping_fee',
//            'transaction_fee',
            'retail_price',
            'gross_profit',
//            'remark',

        ],
    ]); ?>
</div>

<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">评审产品</h4>',
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
$requestAuditUrl = Url::toRoute('create-audit');
$auditJs = <<<JS
        $('.data-audit').on('click', function () {
            $.get('{$requestAuditUrl}', { id: $(this).closest('tr').data('key') },
                function (data) {
                    $('.modal-body').html(data);
                }  
            );
        });
JS;
$this->registerJs($auditJs);

?>
