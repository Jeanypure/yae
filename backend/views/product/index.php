<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('app', 'Products');
$this->title = '销售推荐';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建产品'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],




           // 'product_id',
            'product_title_en',
            'product_title',
            'product_purchase_value',
            [

                'attribute' => 'ref_url1',
                'value' => function ($model, $key, $index, $widget) {
//                    return Html::a('Amazon-link',$model->ref_url1,['target'=>'_blank']);
                    return parse_url($model->ref_url1)['host'];

                },

            ],

            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    return "<a>".parse_url($model->ref_url1)['host']."</a>";
                }
            ], [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    return "<a>".parse_url($model->ref_url2)['host']."</a>";
                }
            ], [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    return "<a>".parse_url($model->ref_url3)['host']."</a>";
                }
            ], [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '其他链接',
                'content' => function ($model, $key, $index, $column){
                    return "<a>".parse_url($model->ref_url4)['host']."</a>";
                }
            ],
//            'ref_url1',
//            'ref_url2',
//            'ref_url3',
//            'ref_url4',
            'product_add_time',     
            'product_update_time',
            'purchaser',
            ['class' => 'yii\grid\ActionColumn'],


        ],
    ]); ?>
</div>
