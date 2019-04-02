<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2019/4/2
 * Time: 11:35
 */
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cost\models\DomesticFreightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '国内运费';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domestic-freight-index">


    <p>
        <?php echo Html::button('标记已审核',['class' => 'btn btn-info' ,'id'=>'sure-checked'])?>
        <?php echo Html::button('标记未审核',['class' => 'btn btn-primary' ,'id'=>'un-checked'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'pjax' =>true,
        'striped' =>true,
        'hover' =>true,
        'id' => 'domestic-fee',
        'panel'=>['type'=>'primary','heading'=>'国内运费列表'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\CheckboxColumn',
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'template' =>'{view} {update}',
                'header' =>'操作',
                'buttons' =>[
                        'view' => function($url,$model,$key){
                            $has = \yii\helpers\Url::toRoute(['checked']);

                            return Html::a('<span class="glyphicon glyphicon-check"></span>', "$has?id=".$key, [
                                'title' => '已审核',
                                'data' => [
                                  'confirm' => "标记已核",
                                ],
                                'data-id' => $key,
                            ] );
                        },
                        'update' => function($url,$model,$key) {
                         $non = \yii\helpers\Url::toRoute(['un-checked']);
                         return Html::a('<span class="glyphicon glyphicon-unchecked"></span>', "$non?id=".$key, [
                             'title' => '取消审核',
                             'data' => [
                               'confirm' => '确认取消'
                             ],
                             'data-id' => $key,
                         ]);
                     }
                ]
            ],
            'purchase_no',
            'sku',
            [
                'class'=>'kartik\grid\FormulaColumn',
                'attribute'=>'freight',
                'format'=>['decimal',3],
                'pageSummary'=>true


            ],
//            'creator',
            'applicant',
            [
                'label'=>'销售组',
                'attribute'=>'subsidiaries',
                'enableSorting' => false,
                'value'=>function($model){
                    $sub = [1=>'商舟',2=>'雅耶',3=>'朗探'];
                    return "{$sub[$model->subsidiaries]}-{$model->group}";
                },
                'headerOptions' => ['style'=>'color:red'],
                'contentOptions' => ['style'=>'color:blue'],
                'filter' => [1=>'商舟',2=>'雅耶',3=>'朗探',4=>'域聪',5=>'鹏侯',6=>'客尊',7=>'朵邦',8=>'1部日本']
            ],
            'application_date:date',
            [
              'label'=>'是否审核?',
              'attribute'=>'has_checked',
              'value'=>function($model){
                    $checked =['否','是'];
                    return "{$checked[$model->has_checked]}";
              },
                'filter' => ['否','是']

            ]
        ],
    ]); ?>
</div>

<?php

// 标记产品状态    0 uncommitted  1 commit
//功能放到 index 批量提交    取消提交

$commit = Url::toRoute(['multi-checked']);
$uncommitted = Url::toRoute(['multi-un-checked']);
$is_submit = <<<JS
    //批量提交
    $('#sure-checked').on('click',function(){
         var button = $(this);
         button.attr('disabled','disabled');
        var ids =  $('#domestic-fee').yiiGridView("getSelectedRows");
        console.log(ids);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$commit}", 
         type: 'post',
         data:{id:ids},
         success:function(res){
           if(res=='success') alert('提交产品成功!');     
           button.attr('disabled',false);
           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
         }
    });
});

//取消提交
    $('#un-checked').on('click',function(){
        var button = $(this);
         button.attr('disabled','disabled');
        var ids =  $('#domestic-fee').yiiGridView("getSelectedRows");
        console.log(ids);
        if(ids==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$uncommitted}", 
         type: 'post',
         data:{id:ids},
         success:function(res){
           if(res=='success') alert('取消提交成功!');
           button.attr('disabled',false);
           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
             button.attr('disabled',false);
         }
      
    });
});
JS;

$this->registerJs($is_submit);
?>