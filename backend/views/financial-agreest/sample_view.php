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
            [
              'attribute'=> 'is_agreest',
              'value'=> function($model){
                    if($model->is_agreest==1){
                        return '同意';
                    }elseif($model->is_agreest==2){
                        return '未处理';
                    }else{
                        return '不同意';
                    }
              },
            ],

//            [
//                'attribute'=> 'is_quality',
//                'value'=> function($model){
//                    if($model->is_quality==1){
//                        return '合格';
//                    }elseif($model->is_quality==0){
//                        return '不合格';
//                    }else{
//                        return '未检测';
//                    }
//                },
//            ],
            [
                'attribute'=> 'fee_return',
                'value'=> function($model){
                    if($model->fee_return==1){
                        return '是';
                    }else{
                        return '否';
                    }
                },
            ],
//            'audit_mem1',
//            'audit_mem2',
//            'audit_mem3',
//            'applicant',
//            'purchaser',
            'create_date',
//            'lastop_date',
        ],
    ]) ?>

</div>
