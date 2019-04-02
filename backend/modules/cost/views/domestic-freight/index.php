<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cost\models\DomesticFreightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '国内运费';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domestic-freight-index">


    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'pjax' =>true,
        'striped' =>true,
        'hover' =>true,
        'panel'=>['type'=>'primary','heading'=>'国内运费列表'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\CheckboxColumn',
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'header' =>'操作'],
            'purchase_no',
            'sku',
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
                'filter' => [1=>'商舟',2=>'雅耶',3=>'朗探',4=>'域聪',5=>'鹏侯',6=>'客尊',7=>'朵邦',8=>'1部日本']
            ],
//            'create_date',
            'application_date:date',
        ],
    ]); ?>
</div>
