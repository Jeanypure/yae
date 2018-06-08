<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '样品采购: ' . $model->pur_info_id, [
    'nameAttribute' => '' . $model->pur_info_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pur_info_id, 'url' => ['view', 'id' => $model->pur_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pur-info-update">

    <img src="<?php echo $model->pd_pic_url?>" alt=""  style="height: 100px;width: 100px">

    <?= $this->render('view', [
        'model' => $model,
    ]) ?>


    <?= $this->render('sample_form', [
        'model' => $sample_model,
    ]) ?>

</div>
