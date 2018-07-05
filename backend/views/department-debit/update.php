<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;

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
        <h3>1需要确认</h3><h4>Shipment ID : <?php echo $model->shipment_id; ?></h4>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'mini_res')->textarea(['maxlength' => true]) ?>
        <?= Html::submitButton('已确认', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <h3>2费用项</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary'=>true,
        'columns' => [
            ['class'=>'kartik\grid\SerialColumn'],

//            'id',
//            'freight_id',
//            'description_id',
            [
                'attribute'=>'description_id',
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->description_id==1){
                        return '海运费' ;
                    }elseif ($model->description_id==2){
                        return '关税' ;
                    }elseif ($model->description_id==3){
                        return '车架费' ;
                    }elseif ($model->description_id==4){
                        return '预提费' ;
                    }elseif ($model->description_id==5){
                        return '国外仓租' ;
                    }elseif ($model->description_id==6){
                        return '滞箱费' ;
                    }elseif ($model->description_id==7){
                        return '超时等候费' ;
                    }elseif ($model->description_id==8){
                        return '周末送货费' ;
                    }elseif ($model->description_id==9){
                        return '落箱费' ;
                    }elseif ($model->description_id==10){
                        return '超重许可' ;
                    }elseif ($model->description_id==11){
                        return '其他费用' ;
                    }else{
                        return '其他' ;
                    }

                },
                'group'=>true,  // enable grouping
                'pageSummary'=>'Page Summary',
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
                    }

                },

            ],
            [
                'attribute'=>'amount',

                'pageSummary'=>true,
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


</div>
