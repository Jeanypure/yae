<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeeCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fee Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fee Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_en',
            'name_zn',
            'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
