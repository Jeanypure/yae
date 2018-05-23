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

<!--    <h1>--><?php //echo  Html::encode($this->title) ?><!--</h1>-->

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
    <p>
        <img src="<?php echo $model->pd_pic_url?>" alt="" width="100" height="100">
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'creator'
        ],
    ]) ?>

</div>
