<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\YaeSupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-supplier-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Yae Supplier', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            'supplier_code',
            'supplier_name',
            'supplier_address',
            'pd_bill_name',
            'bill_unit',
            'submitter',
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
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'开票类型'],

            ],

//            'business_licence',
//            'bank_account_data',
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
                    }elseif ($model->pay_cycleTime_type==0){
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
                    }elseif ($model->account_type==0){
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

//            'bill_img1',
//            'bill_img1_name_unit',
//            'bill_img2',
//            'bill_img2_name_unit',
            'complete_num',
            [
                'attribute'=>'licence_pass',
                'value' => function($model) {
                    if($model->licence_pass==1){
                        return '是';
                    }elseif($model->licence_pass==0){
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
                'filterInputOptions'=>['placeholder'=>'通过?'],

            ],
            [
                'attribute'=>'bill_pass',
                'value' => function($model) {
                    if($model->bill_pass==1){
                        return '是';
                    }elseif($model->bill_pass==0){
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
                'filterInputOptions'=>['placeholder'=>'通过?'],

            ],
            [
                'attribute'=>'bank_data_pass',
                'value' => function($model) {
                    if($model->bank_data_pass==1){
                        return '是';
                    }elseif($model->bank_data_pass==0){
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
                'filterInputOptions'=>['placeholder'=>'通过?'],

            ],

//            'licence_pass',
//            'bill_pass',
//            'bank_data_pass',
            'sup_remark',
            ],
    ]); ?>
</div>

<?php

$del_h3 = <<<JS
    $(function() {
        $('h3').remove();
      
    })
JS;

$this->registerJs($del_h3);


?>