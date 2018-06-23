<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '部长审批'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-view">

    <p>
        <img src="<?php echo  $model->pd_pic_url ?>" alt="" height="100" width="100">
    </p>


    <?php
    if(!empty($sample_model)&&isset($sample_model)){
        echo  $this->render('sample_form', [
            'model' => $sample_model,
        ]);
    }

    ?>


    <h3> 2 样品费用信息 </h3>
    <?= DetailView::widget([
        'model' => $sample_model,
        'attributes' => [
//            'sample_id',
//            'spur_info_id',
            'procurement_cost',
            'sample_freight',
            'else_fee',
            'pay_amount',
            'pay_way',
            'mark',
//            'is_audit',
//            'is_agreest',
//            'is_quality',
            ['attribute'=>'fee_return',
                'value'=>function($model){
                    if($model->fee_return==0){
                        return "是";
                    }else{
                        return "否";
                    }
                }
            ],

//            'audit_mem1',
//            'audit_mem2',
//            'audit_mem3',
//            'applicant',
            'create_date',
            'lastop_date',
        ],
    ]) ?>

</div>
