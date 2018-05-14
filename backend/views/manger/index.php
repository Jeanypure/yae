<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MangerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '经理评审');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preview-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
//        echo Html::a(Yii::t('app', 'Create Preview'), ['create'], ['class' => 'btn btn-success']);
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'product_id',
//            'pd_pic_url',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model['pd_pic_url']. "' width='100' height='100'>";

                }
            ],
            'pd_title',
            'pd_title_en',
//            'member',
//            'member',
//            'content',
//            'result',
            //'priview_time',
            //'member_id',

            'Jenny',
            'admin',
            'Max',
            'Heidi',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> '操作'

            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
