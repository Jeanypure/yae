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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
