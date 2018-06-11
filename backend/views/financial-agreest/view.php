<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = $model->pur_info_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '财务审核'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pur-info-view">
    <p>
        <img src="<?php echo $model->pd_pic_url?>" alt="" height="100" width="100">
    </p>

    <?php
    if(!empty($sample_model)&&isset($sample_model)){
        echo  $this->render('sample_view',[
                'model'=>$sample_model
            ]
        )
        ;
    }

    ?>


</div>
