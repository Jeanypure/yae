<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\bargain\models\RequisitionListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requisition Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Requisition List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'internal_id',
            'requisition_date',
            'document_number',
            'requisition_name',
            //'status',
            //'memo',
            //'amount',
            //'currency',
            //'get_record_time',
            //'push_record_time',
            //'update_record_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
