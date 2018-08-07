<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '采购和审核人员');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchaser-index">

    <p>
        <?= Html::a(Yii::t('app', '添加记录'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'purchaser',
//            'role',
            'memo',
            'code',
            'has_used',
            'grade',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
