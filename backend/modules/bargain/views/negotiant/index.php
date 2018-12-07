<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\bargain\models\NegotiantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Negotiants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negotiant-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Negotiant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'sku_code1',
            'purchaser',
            'negotiant',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
