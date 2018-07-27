<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '采购合同送货单信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-contract-index">


    <p>
        <?php echo Html::button('导出合同',['class' => 'btn btn-warning' ,'id'=>'export-contact'])?>
        <?php echo Html::button('导出送货单',['class' => 'btn btn-success' ,'id'=>'export-delivery'])?>

        <?php
//        echo Html::a('Create New Contract', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'contract',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{audit}',
                'buttons' => [
                    'audit' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-export"></span>', $url, [
                            'title' => '导出合同',
                            'data-toggle' => 'modal',
                            'data-target' => '#audit-modal',
                            'class' => 'data-audit',
                            'data-id' => $key,
                        ] );
                    },
                ],
            ],
            'buy_company',
            'declare_no1',
            'project_no',
            'factory',
            'purchase_contract_no',
            'product_name',
            'unit',
            'quantity',
            'amount',
            'declare_no',
            'purchaser',
            'sku',

        ],
    ]); ?>
</div>

<?php
$js = <<<JS
    $(function() {
        $('h3').remove();
      
    });
JS;
$this->registerJs($js);


?>

<?php
$export = Url::toRoute(['bantch-export']);
$send = Url::toRoute(['send']);
$export_debit =<<<JS
        $(function() {
          $('#export-contact').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                 var ids = $("#contract").yiiGridView("getSelectedRows");
                 var str_id  = ids.toString();
                console.log(str_id);
                if(ids.length ==0) alert('请选择产品后再操作!');
                $.ajax({
                 url: "{$export}", 
                 type: 'get',
                 data:{id:str_id},
                 success:function(res){
                   button.attr('disabled',false);
                   window.location.href = '{$export}'+'?id='+str_id;
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                  });
             });
          $('#export-delivery').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                 var ids = $("#contract").yiiGridView("getSelectedRows");
                 var str_id  = ids.toString();
                 console.log(str_id);
                if(ids.length ==0) alert('请选择产品后再操作!');
                $.ajax({
                 url: "{$send}", 
                 type: 'get',
                 data:{id:str_id},
                 success:function(res){
                   button.attr('disabled',false);
                   window.location.href = '{$send}'+'?id='+str_id;
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                  });
             });
        });
JS;

$this->registerJs($export_debit);

?>