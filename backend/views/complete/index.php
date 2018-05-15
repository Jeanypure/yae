<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompleteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '完成推荐');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complete-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '标记完成'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' =>['style'=>'overflow:auto; white-space:nowrap;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=> '操作',
            ],

//            'product_id',
//            'product_title_ en',
            'product_title',
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
            'product_add_time',
            'product_update_time',
            'purchaser',
            'creator',
            'product_status',
//            'pd_pic_url:url',
            'preview_time',
            'preview_mark',
            'sub_company',
            'sub_company_id',
            'group_mark',
            'group_time',
            'group_update_time',
            'group_status',
            'brocast_status',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '低价Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url_low1)) return "<a href='$model->ref_url_low1' target='_blank'>".parse_url($model->ref_url_low1)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '低价eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url_low2)) return "<a href='$model->ref_url_low2' target='_blank'>".parse_url($model->ref_url_low2)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '低价Wish链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ref_url_low3)) return "<a href='$model->ref_url_low3' target='_blank'>".parse_url($model->ref_url_low3)['host']."</a>";
                }
            ],
//            [
//                'class' => 'yii\grid\Column',
//                'headerOptions' => [
//                    'width'=>'100'
//                ],
//                'header' => '低价其他链接',
//                'content' => function ($model, $key, $index, $column){
//                    if (!empty($model->ref_url_low4)) return "<a href='$model->ref_url_low4' target='_blank'>".parse_url($model->ref_url_low4)['host']."</a>";
//                }
//            ],


//            'ref_url_low1:url',
//            'ref_url_low2:url',
//            'ref_url_low3:url',
//            'ref_url_low4:url',
            'complete_status',
            'creator_id',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
