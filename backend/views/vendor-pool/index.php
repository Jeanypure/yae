<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorPoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商池';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-pool-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>



</div>

<?php
$js = <<<JS
    $(function() {
      $('h3').remove();
    });
JS;
$this->registerJs($js);
?>


