<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = Yii::t('app', 'Update Product: ' . $model->product_id, [
    'nameAttribute' => '' . $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <p>
        <img src="<?php echo $model->pd_pic_url  ;?>" alt="" height="100" width="100">

    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
