<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/8/31
 * Time: 10:59
 */
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use kartik\widgets\ActiveForm;

?>
<?php
    $form = ActiveForm::begin();
echo '<div class="form-group"><div class="row">';
echo '<div class="col-md-4"><label class="control-label">Date Range</label>';
echo '<div class="drp-container">';
echo DateRangePicker::widget([
    'name'=>'date_range_3',
    'value'=>date('Y-m-d',strtotime('-90 day')) . ' - '. date('Y-m-d') ,
    'presetDropdown'=>true,
    'hideInput'=>true
]);
echo '</div></div>';

?>
<!--<div class="form-group">-->
<div class="col-md-4">
<?= Html::submitButton(Yii::t('app', '查询'), ['class' => 'btn-lg btn-success']) ?>
    <?php
//        echo  Html::submitButton('查询', ['id' => 'date-str', 'class' => 'btn btn-primary '])
         ;?>

</div>
</div></br></br>
<?php ActiveForm::end(); ?>
<?php
$dataArr = ['自主开发+销售推荐' => $dataProvider,'自主开发' => $dataProvider3];
foreach ($dataArr as $key=>$value){
    echo GridView::widget([
        'dataProvider' => $value,
        'showPageSummary'=>true,
        'pjax'=>true,
        'export' => false,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'采购开发产品统计--来源'.$key],
        'columns'=>[
            ['class'=>'kartik\grid\SerialColumn'],

            [
                'attribute'=>'purchaser',
                'pageSummary'=>'Page Summary',
                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            ],
            [
                'attribute'=>'reject',
                'label'=>'拒绝',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],
            [
                'attribute'=>'get',
                'label'=>'拿样',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],
            [
                'attribute'=>'need',
                'label'=>'需议价或谈其他条件',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],
            [
                'attribute'=>'undo',
                'label'=>'未评审',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],
            [
                'attribute'=>'direct',
                'label'=>'直接下单',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],[
                'attribute'=>'season',
                'label'=>'季节产品推迟',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\FormulaColumn',
                'header'=>'产品总数',
                'value'=>function ($model, $key, $index, $widget) {
                    $p = compact('model', 'key', 'index');
                    return $widget->col(2, $p) + $widget->col(3, $p)+
                        $widget->col(4, $p)+ $widget->col(5, $p)+ $widget->col(6, $p)+ $widget->col(7, $p);
                },
                'mergeHeader'=>true,
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\FormulaColumn',
                'header'=>'拒绝率%',
                'value'=>function ($model, $key, $index, $widget) {
                    $p = compact('model', 'key', 'index');
                    return $widget->col(2, $p) / $widget->col(8, $p) *100;
                },
                'mergeHeader'=>true,
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 2],
//            'pageSummary'=>true,
                'pageSummaryFunc'=>GridView::F_AVG,
            ],
            [
                'class'=>'kartik\grid\FormulaColumn',
                'header'=>'成功率%',
                'value'=>function ($model, $key, $index, $widget) {
                    $p = compact('model', 'key', 'index');
                    return ($widget->col(3, $p)+ $widget->col(6, $p))/ $widget->col(8, $p) *100;
                },
                'mergeHeader'=>true,
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 2],
//            'pageSummary'=>true,
                'pageSummaryFunc'=>GridView::F_AVG,

            ],
        ],
    ]);
}

echo GridView::widget([
    'dataProvider' => $dataProvider2,
    'showPageSummary'=>true,
    'pjax'=>true,
    'export' => false,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'primary', 'heading'=>'采购开发产品统计 -- 来源销售推荐'],
    'columns'=>[
        ['class'=>'kartik\grid\SerialColumn'],

        [
            'attribute'=>'purchaser',
            'pageSummary'=>'Page Summary',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
        ],

        [
            'attribute'=>'reject',
            'label'=>'拒绝',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'get',
            'label'=>'拿样',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'need',
            'label'=>'需议价或谈其他条件',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'undo',
            'label'=>'未评审',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'direct',
            'label'=>'直接下单',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],[
            'attribute'=>'season',
            'label'=>'季节产品推迟',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'产品总数',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                return $widget->col(2, $p) + $widget->col(3, $p)+
                    $widget->col(4, $p)+ $widget->col(5, $p)+ $widget->col(6, $p)+ $widget->col(7, $p);
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'拒绝率%',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                return ($widget->col(8, $p) *100>0)?$widget->col(2, $p) / $widget->col(8, $p) *100:0;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
//            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_AVG,
        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'成功率%',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');

                return ($widget->col(8, $p) *100>0)?(($widget->col(3, $p)+ $widget->col(6, $p))/ $widget->col(8, $p) *100):0;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
//            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_AVG,

        ],

        [
            'attribute'=>'commit_num',
            'label'=>'已提交',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'uncommit_num',
            'label'=>'未处理',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 0],
            'pageSummary'=>true
        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'未处理率%',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                return ($widget->col(12, $p))/ ($widget->col(11, $p)+ $widget->col(12, $p)) *100;
            },
            'mergeHeader'=>true,
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
//            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_AVG,

        ],
    ],
]);
?>
<?php
    $submit = Url::toRoute('compute');
    $js =<<<JS
    $('#date-str').on('click',function() {
      var button = $(this);
      button.attr('disabled','disabled');
      var date_range = $('#w1').val();
      console.log(date_range);
      $.ajax({
          url:'{$submit}',
          type: 'post',
          data:{date_range:date_range},
          success:function(data) {
            button.attr('disabled',false);
          }
      });
    });
JS;

//$this->registerJs($js);
?>
