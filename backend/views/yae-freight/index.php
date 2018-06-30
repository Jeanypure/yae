<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\YaeFreightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '货单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-index">

        <?= Html::a('Create Freight', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作'
            ],
            'shipment_id',
            'bill_to',
            'receiver',
            'pod',
            'pol',
            'etd',
            'eta',
            'remark',

        ],
    ]); ?>
</div>

<?php
 $js = <<<JS
   $(function() {
     $('h3').remove();
   });
JS;
 $this->registerJs($js);
?>
