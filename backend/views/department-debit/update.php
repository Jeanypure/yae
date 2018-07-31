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
        <h3>1 需确认信息</h3>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute'=>'bill_to',
                    'format'=>'raw',
                    'value' => function ($model) {
                        if($model->bill_to ==1 ){
                            return '上海商舟船舶用品有限公司';
                        }elseif($model->bill_to ==2 ){
                            return '上海雅耶贸易有限公司';
                        }elseif($model->bill_to ==3 ){
                            return '上海朗探贸易有限公司';
                        }elseif($model->bill_to ==4 ){
                            return '上海域聪贸易有限公司';
                        }elseif($model->bill_to ==5 ){
                            return '上海朋侯贸易有限公司';
                        }elseif($model->bill_to ==6 ) {
                            return '上海客尊贸易有限公司';
                        }else{
                            return '其他';
                        }
                    },
                ],
                'receiver',
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
    <h3>2 费用项</h3>
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
                'format'=>['decimal', 2],

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
                'pageSummaryOptions'=>['class'=>'text-left text-warning'],
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
    <?= $form->field($model, 'mini_res')->textarea(['maxlength' => true]) ?>
    <?= Html::submitButton('已确认', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

</div>
