<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeFreight */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Freights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-freight-view">
<p>
    <img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$model->image;?>" width="100" height="100" alt="" />
</p>
    <p>
        <?php
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
                    }elseif($model->bill_to ==6 ){
                        return '上海客尊贸易有限公司';
                    }

                },
            ],
            [
                'attribute'=>'receiver',
                'format'=>'raw',
                'value' => function ($model) {
                    if($model->receiver ==1 ){
                        return '深圳大森林国际货代有限公司';
                    }elseif($model->receiver ==2 ){
                        return '上海珑瑗国际货物运输代理有限公司';
                    }elseif($model->receiver ==3 ){
                        return '上海昊宏国际货物运输代理有限公司';
                    }elseif($model->receiver ==4 ){
                        return '深圳市安泰克物流有限公司';
                    }elseif($model->bill_to ==5 ){
                        return '文鼎供应链管理(上海)有限公司';
                    }else{
                        return '其他';
                    }
                },
            ],
            'contract_no',
            'debit_no',
            'shipment_id',
            'pod',
            'pol',
            'etd',
            'eta',
            'remark',
        ],
    ]) ?>

</div>
