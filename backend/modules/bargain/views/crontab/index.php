<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\bargain\models\CrontabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Crontabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crontab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Crontab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'route',
            'crontab_str',
            'switch',
            'status',
            'last_rundate',
            'next_rundate',
            'execmemory',
            'exectime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
