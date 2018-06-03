<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BrocastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '公示列表';
$this->params['breadcrumbs'][] = $this->title;
$sub_title = '销售推荐产品';
?>
<div class="product-index">

    <h5><?= Html::encode($sub_title.$this->title) ?></h5>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
//        echo Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ;
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' =>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            'sub_company',
            [
                'attribute'=>'product_title',
                'value' => function($model) { return $model->product_title;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
            ],
            [
                'attribute'=>'product_title_en',
                'value' => function($model) { return $model->product_title_en;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
            ],
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
            //'product_add_time',
            //'product_update_time',
            //'purchaser',
            'creator',
            //'product_status',
            //'pd_pic_url:url',
            //'preview_time',
            //'preview_mark',
            //'sub_company',
            //'sub_company_id',
            //'group_mark',
//            'group_time',
//            'group_update_time',
//            'group_status',
            [
                'attribute'=>'brocast_status',
                'value' => function($model) {
                    if($model->brocast_status==0){
                        return '未公示';
                    }elseif ($model->brocast_status==1){
                        return '公示中';

                    }else{
                        return '公示结束';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '未公示','1' => '公示中', '2' => '公示结束'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'公示状态'],
                'group'=>true,  // enable grouping

            ],


//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
