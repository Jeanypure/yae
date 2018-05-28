<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PreviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Previews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preview-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Preview'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php
      echo
      GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options'=>[
                'style'=>'overflow: auto; white-space:nowrap'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'preview_id',
            'member2',
            'product_id',
            'content',
            'result',
            'priview_time',
            'member_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
      ?>
</div>
