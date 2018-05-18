<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\YaeUserFoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Yae User Foods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-user-food-index">

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?php //echo  Html::a(Yii::t('app', 'Create Yae User Food'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user.username',
            'yaeFoodLists.food_name',
//            'user_id',
//            'food_id',
            'note',
            'order_date',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
