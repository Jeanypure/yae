<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorPoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商池';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-pool-index">


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ])
    ?>

</div>
