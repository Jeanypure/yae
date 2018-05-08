<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('app', 'Products');
$this->title = '评审产品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '批量通过 '), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量导入', "javascript:void(0);", ['title' => 'upload', 'class' => 'upload btn btn-info']) ?>
        <?= Html::a('批量删除', "javascript:void(0);", ['title' => 'deleteLots', 'class' => 'delete-lots btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
//            'style'=>'overflow: auto; word-wrap: break-word;'
            'style'=>'overflow: auto; white-space:nowrap;'
        ],
        'options' => ['class' => 'grid-view','style'=>'overflow:auto', 'id' => 'grid'],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
//                'template' => '{ok} {view} {update} {delete} ',
                'template' => '{ok} {view} ',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            'title' => '删除',
                            'aria-label' => '删除',
                            'data-id' => $key,
                            'class' => 'index-delete',
                        ];
                        return Html::a('<span  class="glyphicon glyphicon-trash"></span>', '#', $options);
                    },
                    'view' => function ($url, $model, $key) {
                        $options = [
                            'title' => '查看',
                            'aria-label' => '查看',
                            'data-toggle' => 'modal',
                            'data-target' => '#index-modal',
                            'data-id' => $key,
                            'class' => 'index-view',
                        ];
                        return Html::a('<span  class="glyphicon glyphicon-eye-open"></span>', '#', $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => '更新',
                            'aria-label' => '更新',
                            'data-toggle' => 'modal',
                            'data-target' => '#index-modal',
                            'data-id' => $key,
                            'class' => 'index-update',
                        ];
                        return Html::a('<span  class="glyphicon glyphicon-pencil"></span>', '#', $options);
                    },
                    'ok' => function ($url, $model, $key) {
                        $options = [
                            'title' => '评审',
                            'aria-label' => '评审 ',
                            'data-toggle' => 'modal',
                            'data-target' => '#index-modal',
                            'data-id' => $key,
                            'class' => 'data-ok',
                        ];
                        return Html::a('<span  class="glyphicon glyphicon-ok"></span>', '#', $options);
                    }
                ],

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
                    if (!empty($model->ref_url1)) return "<a href='$model->ref_url1' target='_blank'>".parse_url($model->ref_url1)['host'] ."</a>";
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
            'product_add_time:date',
            'purchaser',
            'creator',
            'product_status',

        ],
    ]);

    $this->registerJs('
        $(".gridview").on("click", function () {
            var keys = $("#grid").yiiGridView("getSelectedRows");
            console.log(keys);
        });
    ');
    ?>


</div>
