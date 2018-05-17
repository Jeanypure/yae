<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '分到部门产品');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <p>
        <?= Html::a(Yii::t('app', '接受'), ['#'], ['class' => 'btn btn-success' ,'id'=>'accept' ]) ?>
        <?= Html::a(Yii::t('app', '拒绝'), ['#'], ['class' => 'btn btn-danger','id'=>'reject' ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'department',
        'options' => [
            'style'=>'overflow: auto;  white-space:nowrap;'
        ],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'bordered' => 1,
        'condensed' => 1,
        'export' =>false,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                    'template' => '{audit} {view}  {update}  {delete}',
//                'template' => ' {view} {update} {delete}',
                'buttons' => [
                    'audit' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-send"></span>', $url, [
                            'title' => '发送采购',
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
            'product_title',
            'product_title_en',
            'product_purchase_value',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url1)) return "<a href='$model->ref_url1' target='_blank'>".parse_url($model->ref_url1)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url2))  return "<a href='$model->ref_url2' target='_blank'>".parse_url($model->ref_url2)['host']."</a>";

                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url3))  return "<a href='$model->ref_url3' target='_blank'>".parse_url($model->ref_url3)['host']."</a>";

                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '其他链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url4))  return "<a href='$model->ref_url4' target='_blank'>".parse_url($model->ref_url4)['host'] ."</a>";



                }
            ],
            'product_add_time:date',
            'product_update_time:date',
            'creator',
//            'product_status',
            'complete_status',
//            'purchaser',
        ],
    ]); ?>
</div>

<?php
use yii\bootstrap\Modal;
// 评审操作
Modal::begin([
    'id' => 'audit-modal',
    'header' => '<h4 class="modal-title">可供选的采购</h4>',
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
$requestAuditUrl = Url::toRoute('pick-purchaser');
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





<?php
$accept = Url::toRoute(['department/accept']);
$reject = Url::toRoute(['department/reject']);


$js = <<<JS
    //批量接受
    $('#accept').on('click',function(){
            var ids = $("#department").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) return false;
            $.ajax({
                url:'{$accept}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
                }
            });
    });

//批量拒绝
    $('#reject').on('click',function(){
            var ids = $("#department").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) return false;
            $.ajax({
                url:'{$reject}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
                    location.reload();
                }
            });
    });

JS;
$this->registerJs($js);



?>




