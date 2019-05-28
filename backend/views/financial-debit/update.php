<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = 'Update Yae Freight: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yae Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="yae-freight-update">
    <div>
        <p>
            <img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$model->image;?>" width="100" height="100" alt="" />
        </p>
        <div class="yae-freight-form">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <legend class="text-info"><h4>图片信息</h4></legend>
            <?php
            echo $form->field($model, 'image')->widget('manks\FileInput',  [
                'clientOptions' => [
                    'pick' => [
                        'multiple' => true,
                    ],
                ]
            ]);

            ?>
        </div>
        <?php ActiveForm::end(); ?>
        <h3>1 需确认信息</h3>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute'=>'bill_to',
                    'format'=>'raw',
                    'value' => function ($model) {
                        $suffix = [ '1' => '商舟', '2' => '雅耶', '3' => '朗探', '4' => '域聪', '5' => '鹏侯', '6' => '客尊','9'=>'杭州雅耶'];
                        return $suffix[$model->bill_to];
                    },
                ],
                [
                    'attribute'=>'receiver',
                    'format'=>'raw',
                    'value' => function ($model) {
                        $company = [ '1' => '大森林', '2' => '珑瑗', '3' => '昊宏', '4' => '安泰克', '5' => '文鼎','6'=>'龙辕',
                            '7'=>'瀚明','8'=>'德威','9'=>'世纪卓越','10'=>'优备艾佳'];
                        return $company[$model->receiver];
                    },
                ],
                'shipment_id',
                'pod',
                'pol',
                'etd',
                'eta',
                'remark',
                [
                    'attribute'=>'to_minister',
                    'format'=>'raw',
                    'value' => function ($model) {
                        if($model->to_minister ==1 ){
                            return '已提交';
                        }else{
                            return '未提交';
                        }
                    },
                ],
                [
                    'attribute'=>'to_financial',
                    'format'=>'raw',
                    'value' => function ($model) {
                        if($model->to_financial ==1 ){
                            return '已提交';
                        }else{
                            return '未提交';
                        }
                    },
                ],
                [
                    'attribute'=>'mini_deal',
                    'format'=>'raw',
                    'value' => function ($model) {
                        if($model->mini_deal ==1 ){
                            return '已处理';
                        }else{
                            return '未处理';
                        }
                    },
                ],
                [
                    'attribute'=>'fina_deal',
                    'format'=>'raw',
                    'value' => function ($model) {
                        if($model->fina_deal ==1 ){
                            return '已处理';
                        }else{
                            return '未处理';
                        }
                    },
                ],
                'mini_res',
                'fina_res',
            ],
        ]) ?>

    </div>
    <h3>2费用项</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary'=>true,
        'columns' => [
            ['class'=>'kartik\grid\SerialColumn'],
            [
                'attribute'=>'name_zn',
                'width'=>'310px',

            ],
            [
                'attribute'=>'quantity',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->quantity;
                },
                'pageSummary'=>true,


            ],

            [
                'attribute'=>'unit_price',
                'width'=>'150px',
                'hAlign'=>'right',
//                'format'=>['decimal', 2],

            ],
            [
                'attribute'=>'currency',
                'width'=>'100px',

                'value'=>function ($model, $key, $index, $widget) {
                    if($model->currency==1){
                        return 'USD';
                    }elseif ($model->currency==2){
                        return 'GBP';
                    }elseif ($model->currency==3){
                        return 'CAD';
                    }elseif ($model->currency==4){
                        return 'EUR';
                    }elseif ($model->currency==5){
                        return 'RMB';
                    }

                },

            ],
            [
                'attribute'=>'amount',

//                'pageSummary'=>true,
//                'pageSummaryOptions'=>['class'=>'text-left text-warning'],
            ],
            [
                'attribute'=>'remark',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->remark;
                },

            ],
        ],
    ]); ?>
    <h3>3 按币种汇总</h3>
    <?php
    echo '<table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">';
    echo '<thead><tr><th>Currency</th><th>Total</th></tr></thead>';
    foreach ($total as $k=>$v){
        echo '<tr><td>';
        echo $v['currency'];
        echo '</td><td>';
        echo $v['total'];
        echo '</td></tr>';
    }
    echo '</table>';

    ?>
    <h3>4 备注</h3>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'fina_res')->textarea(['maxlength' => true]) ?>
    <?= Html::submitButton('已确认', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>


</div>
