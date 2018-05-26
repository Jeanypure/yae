<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\YaeExchangeRateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Yae Exchange Rates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-exchange-rate-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建汇率'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'exchange_rate',
            'memo',
            'currency',

            [
                    'class' => 'yii\grid\ActionColumn',
                   'header'=>'操作'

            ],
        ],
    ]); ?>
</div>
