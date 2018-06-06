<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modelsSampleTrackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sample Tracks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-track-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sample Track'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sample_id',
            'spur_info_id',
            'procurement_cost',
            'sample_freight',
            'else_fee',
            //'pay_amount',
            //'pay_way',
            //'mark',
            //'is_audit',
            //'is_agreest',
            //'is_quality',
            //'fee_return',
            //'audit_mem1',
            //'audit_mem2',
            //'audit_mem3',
            //'applicant',
            //'create_date',
            //'lastop_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
