<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\bargain\models\LotnumberedInventoryItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SKU议价人';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lotnumbered-inventory-item-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'sku',
            'property',
            'bargain',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
