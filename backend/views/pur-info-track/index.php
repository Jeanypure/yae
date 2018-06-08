<?php


use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurInfoTrackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '采样申请');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">


    <p>
        <?= Html::a(Yii::t('app', 'Create Pur Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update}',
            ],



//            'pur_info_id',
            'spur_info_id',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                }
            ],

            'purchaser',
            [
                'attribute'=>'pur_group',
                'value' => function($model) {
                    if($model->pur_group==1){
                        return '一部';
                    }elseif ($model->pur_group==2){
                        return '二部';
                    }elseif ($model->pur_group==3){
                        return '三部';
                    }elseif ($model->pur_group==4){
                        return '四部';
                    }elseif ($model->pur_group==5){
                        return '五部';
                    }elseif ($model->pur_group==6){
                        return '六部';
                    }elseif ($model->pur_group==7){
                        return '七部';
                    }elseif ($model->pur_group==8){
                        return '八部';
                    }
                },
                'contentOptions'=> ['style' => 'width: 10%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '一部', '2' => '二部','3' => '三部','4' => '四部','5' => '五部','6' => '六部','7' => '七部','8' => '八部',],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'部门'],
                'group'=>true,  // enable grouping

            ],

            [
                'attribute'=>'pd_title',
                'value' => function($model) { return $model->pd_title;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'pd_title_en',
                'value' => function($model) { return $model->pd_title_en;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'master_result',
                'value' => function($model) {
                    if($model->master_result==0){
                        return '拒绝';
                    }elseif($model->master_result==1){
                        return '采样';

                    }elseif($model->master_result==2){
                        return '需议价和谈其他条件';

                    }elseif($model->master_result==3){
                        return '尚未评';

                    }elseif($model->master_result==4){
                        return '直接下单';

                    }elseif($model->master_result==5){
                        return '季节产品推迟';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '拒绝', '1' => '采样', '2' => '需议价和谈其他条件', '3' => '尚未评', '4' => '直接下单', '5' => '季节产品推迟'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审状态'],
            ],
            [
                'attribute'=>'master_mark',
                'value' => function($model) { return $model->master_mark;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            //'pd_pic_url:url',
            //'pd_package',
            //'pd_length',
            //'pd_width',
            //'pd_height',
            //'is_huge',
            //'pd_weight',
            //'pd_throw_weight',
            //'pd_count_weight',
            //'pd_material',
            //'pd_purchase_num',
            //'pd_pur_costprice',
            //'has_shipping_fee',
            //'bill_type',
            //'hs_code',
            //'bill_tax_rebate',
            //'bill_rebate_amount',
            //'no_rebate_amount',
            //'retail_price',
            //'ebay_url:url',
            //'amazon_url:url',
            //'url_1688:url',
            //'else_url:url',
            //'shipping_fee',
            //'oversea_shipping_fee',
            //'transaction_fee',
            //'gross_profit',
            //'remark',
            //'parent_product_id',
            //'source',
            //'member',
            //'preview_status',
            //'brocast_status',
            //'master_member',
            //'master_mark',
            //'master_result',
            //'priview_time',
            //'ams_logistics_fee',
            //'is_submit',
            //'pd_create_time',
            //'is_submit_manager',
            //'pur_group_status',
            //'purchaser_leader',
            //'junior_submit',
            //'profit_rate',
            //'gross_profit_amz',
            //'profit_rate_amz',
            //'amz_fulfillment_cost',
            //'selling_on_amz_fee',
            //'amz_retail_price',
            //'amz_retail_price_rmb',
            //'is_assign',
            //'commit_date',

        ],
    ]); ?>
</div>
