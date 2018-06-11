<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sample */

$this->title = $model->sample_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'procurement_cost',
            'sample_freight',
            'else_fee',
            'pay_amount',
            'pay_way',
            'mark',
            'is_audit',
            'is_agreest',
            [
              'attribute'=> 'is_agreest',
              'value'=> 'is_agreest',
            ],
            'is_quality',
            'fee_return',
//            'audit_mem1',
//            'audit_mem2',
//            'audit_mem3',
//            'applicant',
//            'create_date',
//            'lastop_date',
        ],
    ]) ?>

</div>
