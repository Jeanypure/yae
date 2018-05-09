<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'product_id',
            'product_title_en',
            'product_title',
            'product_purchase_value',
            'ref_url1',
            'ref_url2',
            'ref_url3',
            'ref_url4',
            'product_add_time',
            'product_update_time',
            'purchaser',
            'creator',
            'product_status',
            'pd_pic_url:url',
            'preview_time',
            'preview_mark',
//            'sub_company_id',
        ],
    ]) ?>

</div>
