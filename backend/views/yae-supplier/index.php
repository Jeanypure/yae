<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\YaeSupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Yae Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yae-supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Yae Supplier', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'supplier_code',
            'supplier_name',
            'supplier_address',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
