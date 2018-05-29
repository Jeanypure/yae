<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->product_id;
?>
<div class="product-view">
    <img src="<?= Html::encode($model->pd_pic_url)?>" height="100" width="100"/>


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sub_company',
            'group_status',
            'group_mark',
            'product_id',
            'product_title_en',
            'product_title',
            'product_purchase_value',

            ['attribute'=>'ref_url1','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url2','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url3','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url4','format'=>['url',['target'=>'_blank']]],


            'product_add_time',
            'product_update_time',
//            'purchaser',
            'creator',
            'product_status',
            'pd_pic_url:url',
            'preview_time',
//            'sub_company_id',
        ],
    ]) ?>

</div>
