<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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
        'showPageSummary'=>true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\CheckboxColumn'],
            ['class' => 'kartik\grid\ActionColumn'],
//            'dfid',
            'purchase_no',
            'sku',
//            'freight',
            [
                'class'=>'kartik\grid\FormulaColumn',
                'attribute'=>'freight',
                'format'=>['decimal',3],
                'pageSummary'=>true


            ],
//            'creator',
            'applicant',
            [
                'label'=>'销售组',
                'attribute'=>'subsidiaries',
                'enableSorting' => false,
                'value'=>function($model){
                    $sub = [1=>'商舟',2=>'雅耶',3=>'朗探'];
                    return "{$sub[$model->subsidiaries]}-{$model->group}";
                },
                'headerOptions' => ['style'=>'color:red'],
                'contentOptions' => ['style'=>'color:blue'],
            ],
//            'create_date',
            'application_date:date',
        ],
    ]); ?>
</div>
