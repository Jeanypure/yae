<?php

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FollowCheckVendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查供应商--跟单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-supplier-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'commit_vendor',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '  {update}',
            ],

            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->business_licence. "' width='100' height='100'>";


                }
            ],

            'supplier_code',
            'supplier_name',
            'supplier_address',
            [
                'attribute'=>'is_submit_vendor',
                'value' => function($model) {
                    if($model->is_submit_vendor==1){
                        return '已提交';
                    }else{
                        return '未提交';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'提交?'],

            ],
            'create_date',
            'submitter',
            'checker',
            [
                'attribute'=>'check_status',
                'value' => function($model) {
                    if($model->check_status==1){
                        return '通过';
                    }elseif ($model->check_status==2){
                        return '半通过';
                    }elseif ($model->check_status==0){
                        return '不通过';
                    }else{
                        return '未处理';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '不通过','1' => '通过','2' => '半通过','3' => '未处理',],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'审核状态'],

            ],

            [
                'attribute'=>'check_memo',
                'value' => function($model) { return $model->check_memo;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],

            [
                'attribute'=>'bill_type',
                'value' => function($model) {
                    if($model->bill_type==0){
                        return '16%专票';
                    }elseif ($model->bill_type==1){
                        return '3%专票';
                    }elseif ($model->bill_type==2){
                        return '增值税普通发票';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '16%专票','1' => '3%专票','2' => '增值税普通发票', ],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'开票类型'],

            ],

            'pay_card',
            'pay_name',
            'pay_bank',
            [
                'attribute'=>'pay_cycleTime_type',
                'value' => function($model) {
                    if($model->pay_cycleTime_type==1){
                        return '日结';
                    }elseif ($model->pay_cycleTime_type==2){
                        return '周结';
                    }elseif ($model->pay_cycleTime_type==3){
                        return '半月结';
                    }elseif ($model->pay_cycleTime_type==4){
                        return '月结';
                    }elseif ($model->pay_cycleTime_type==5){
                        return '隔月结';
                    }elseif ($model->pay_cycleTime_type==6){
                        return '其他';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '日结', '2' => '周结','3' => '半月结','4' => '月结','5' => '隔月结','0' => '其他'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'类型'],

            ],
            [
                'attribute'=>'account_type',
                'value' => function($model) {
                    if($model->account_type==1){
                        return '货到付款';
                    }elseif ($model->account_type==2){
                        return '款到发货';
                    }elseif ($model->account_type==3){
                        return '周期结算';
                    }elseif ($model->account_type==4){
                        return '售后付款';
                    }elseif ($model->account_type==5){
                        return '默认方式';
                    }elseif ($model->account_type==6){
                        return '其他';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '日结', '2' => '周结','3' => '半月结','4' => '月结','5' => '隔月结','0' => '其他'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'方式'],

            ],
            'account_proportion',
            [
                'attribute'=>'has_cooperate',
                'value' => function($model) {
                    if($model->has_cooperate==1){
                        return '是';
                    }elseif($model->has_cooperate==0){
                        return '否';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'合作过?'],

            ],

            'sup_remark',
        ],
    ]); ?>
</div>
