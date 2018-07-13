<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yae Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-supplier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'supplier_code',
            'supplier_name',
            'pd_bill_name',
            'bill_unit',
            'submitter',
            'bill_type',
            'business_licence',
            'bank_account_data',
            'pay_card',
            'pay_name',
            'pay_bank',
            'sup_remark',
            'pay_cycleTime_type:datetime',
            'account_type',
            'account_proportion',
            'has_cooperate',
            'bill_img1',
            'bill_img1_name_unit',
            'bill_img2',
            'bill_img2_name_unit',
            'complete_num',
            'licence_pass',
            'bill_pass',
            'bank_data_pass',
            'supplier_address',
            'is_submit_vendor',
            'check_status',
            'check_memo',
        ],
    ]) ?>

</div>
