<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cost\models\DomesticFreightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '国内运费';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domestic-freight-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
//            'dfid',
            'purchase_no',
            'sku',
            'freight',
//            'creator',
            'applicant',
            'subsidiaries',
            'group',
//            'create_date',
            'application_date:date',
        ],
    ]); ?>
</div>
