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

    <h3> 3 产品详情 </h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pur_info_id',
//            'preview_status',
            'purchaser',
            'pur_group',
            'pd_title',
            'pd_title_en',
            ['attribute'=>'pd_pic_url','format'=>['url',['target'=>'_blank']]],
            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            ['attribute'=>'is_huge',
                'value'=>function($model){
                    if($model->is_huge==0){
                        return "是";
                    }else{
                        return "否";
                    }
                }
            ],
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
            ['attribute'=>'has_shipping_fee',
                'value'=>function($model){
                    if($model->has_shipping_fee==0){
                        return "是";
                    }else{
                        return "否";
                    }
                }
            ],

            'bill_type',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            'no_rebate_amount',
            'retail_price',
            ['attribute'=>'ebay_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'amazon_url','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'url_1688','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'else_url','format'=>['url',['target'=>'_blank']]],
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'profit_rate',
            'gross_profit_amz',
            'profit_rate_amz',
            'selling_on_amz_fee',
            'amz_fulfillment_cost',
            'remark',
//            'parent_product_id',
        ],
    ]) ?>

</div>
