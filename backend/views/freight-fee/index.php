<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FreightFeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Freight Fees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-fee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Freight Fee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'freight_id',
            'description_id',
            'quantity',
            'unit_price',
            //'currency',
            //'amount',
            //'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
