<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/5/25
 * Time: 下午4:00
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $preview_model backend\models\Preview */

$this->title = $preview_model->preview_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preview-view">
<h3> <?php
    echo $preview_model->member
    ?>评审结果</h3>


    <?= DetailView::widget([
        'model' => $preview_model,
        'attributes' => [
//            'preview_id',
            'member',
//            'product_id',
            'result',
            'content',
            'priview_time',
//            'member_id',
        ],
    ]) ?>

</div>
