<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '样品申请: ' . $model->pur_info_id, [
    'nameAttribute' => '' . $model->pur_info_id,
]);
?>
<div class="pur-info-update">

    <img src="<?php echo $model->pd_pic_url?>" alt=""  style="height: 100px;width: 100px">

    <?= $this->render('sample_form', [
        'model' => $sample_model,
    ]) ?>
    <legend class="text-info"><h3>2.产品详细信息</h3></legend>
    <?= $this->render('view', [
        'model' => $model,
    ]) ?>
</div>
